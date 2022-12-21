<?php


require_once __DIR__ . '/vendor/autoload.php';
require_once 'functions.php';

$config = json_decode(file_get_contents('config.json'), true);
global $config;
use Medoo\Medoo;
$database = new Medoo(
    [
        'database_type' => 'pgsql',
        'database_name' => $config['db']['name'],
        'server' => $config['db']['host'],
        'username' => $config['db']['user'],
        'password' => $config['db']['password'],
        'charset' => 'utf8',
        'port' =>  $config['db']['port'],
        'command' => [
            'SET search_path TO ' . $config['db']['schema'],
        ],
    ]
);

global $database;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use ProxmoxVE\Proxmox;

$connection = new AMQPStreamConnection($config["rabbitMq"]["host"], $config["rabbitMq"]["port"], $config["rabbitMq"]["username"], $config["rabbitMq"]["password"]);
$channel = $connection->channel();

$channel->queue_declare('ph24_vserver', false, true, false, false);

$callback = function ($msg) {
    global $database;
    global $config;
    $message = json_decode($msg->body, true);
    $id = $message["id"];

    $queue = $database->select('vserver_queue', '*', ["id" => $id]);

    $queueData = $queue[0];

    $vserverData = $database->select('vserver_main', '*', ["id" => $queueData["vserverid"]]);

    $vserverData = $vserverData[0];

    $nodeData = $database->select('vserver_nodes', '*', ["id" => $vserverData["nodeid"]]);

    $nodeData = $nodeData[0];

    $taskList = $database->select('vserver_queue_tasks', '*', ["queueid" => $queueData["id"],"status" => [0,1], "ORDER" => ["id" => "ASC"]]);

    $queueDataStorage = $database->select('vserver_queue_data', '*', ["queueid" => $queueData["id"]]);

    $queueDataStorageFormated = [];

    foreach ($queueDataStorage as $storage){
        $queueDataStorageFormated[$storage["key"]] = $storage["value"];
    }
    $queueDataStorage = $queueDataStorageFormated;

    $credentials = [
        'hostname' => $nodeData["hostname"],
        'username' => $nodeData["username"],
        'password' => encrypt_decrypt("decrypt", $nodeData["password"], $config["key"], $config["key"]),
        'realm' => 'pve',
    ];
    $proxmoxClient = new Proxmox($credentials);
    $database->update('vserver_queue', [
        "status" => 1
    ],[
        "id" => $queueData["id"]
    ]);
    echo "Start work on queue entry " . $queueData["id"] ." with " . count($taskList) . " tasks (VM " . $queueData["vserverid"] . "). \n";

    $error = false;
    foreach ($taskList as $taskEntry){
        unset($result);
        $database->update('vserver_queue_tasks', [
            "status" => 1
        ],[
            "id" => $taskEntry["id"]
        ]);
        switch ($taskEntry["action"]){
            case 'start':
                $repeatTime = 500000;
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/status/start');
                echo "Send start request to ProxmoxAPI \n";
                break;
            case 'stop':
                $repeatTime = 500000;
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/status/stop');
                echo "Send stop request to ProxmoxAPI \n";
                break;
            case 'shutdown':
                $repeatTime = 500000;
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/status/shutdown',[
                    "timeout" => 30
                ]);
                echo "Send shutdown request to ProxmoxAPI\n";
                break;
            case 'reset':
                $repeatTime = 500000;
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/status/reset');
                echo "Send reset request to ProxmoxAPI \n";
                break;
            case 'delete':
                $repeatTime = 500000;
                $result = $proxmoxClient->delete('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"]);
                echo "Send delete request to ProxmoxAPI \n";
                break;
            case 'create':
                $repeatTime = 1000000;
                $info = [
                    "newid" => $vserverData["proxmoxid"],
                    "description" => $queueDataStorage["proxmoxDescription"],
                    "format" => "qcow2",
                    "full" => true,
                    "name" => 'v' . $vserverData["proxmoxid"] . '.prohosting24.de',
                    "target" => $queueDataStorage["targetNode"],
                ];
                $nodeData["nameNormal"] = $nodeData["name"];
                $nodeData["name"] = "ph24-6";
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $queueDataStorage["image"] . '/clone', $info);
                echo "Send clone request to ProxmoxAPI \n";
                break;
            case 'configOnly':
                $repeatTime = 200000;
                $proxmoxClient->set('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/resize', [
                    "disk" => "scsi0",
                    "size" => $vserverData["disk"] . 'G',
                ]);
                $ipData = json_decode($queueDataStorage["ipData"],true);
                if(isset($ipData["ipV6"][0]["gw"])){
                    $info = [
                        'cores' => $vserverData["cores"],
                        'memory' => $vserverData["memory"],
                        'cipassword' => $vserverData["firstpw"],
                        'ciuser' => 'root',
                        'net0' => 'virtio=' . $vserverData["mac"] . ',bridge=vmbr0,rate=90,firewall=1',
                        'ipconfig0' => 'gw=' . $ipData["ipV4Subnet"][$ipData["ipV4"][0]["subnet"]]["gw"] . ',ip=' . $ipData["ipV4"][0]["ip"] . '/24,gw6=' . $ipData["ipV6"][0]["gw"] . ',ip6=' . $ipData["ipV6"][0]["netmask"] . '/64'
                    ];
                } else {
                    $info = [
                        'cores' => $vserverData["cores"],
                        'memory' => $vserverData["memory"],
                        'cipassword' => $vserverData["firstpw"],
                        'ciuser' => 'root',
                        'net0' => 'virtio=' . $vserverData["mac"] . ',bridge=vmbr0,rate=90,firewall=1',
                        'ipconfig0' => 'gw=' . $ipData["ipV4Subnet"][$ipData["ipV4"][0]["subnet"]]["gw"] . ',ip=' . $ipData["ipV4"][0]["ip"] . '/24'
                    ];
                }
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/config', $info);
                break;
            case 'windowsSetNetwork':
                $repeatTime = 300000;
                $agentNotRunning = true;
                while ($agentNotRunning){
                    usleep($repeatTime);
                    $result = $proxmoxClient->get('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/agent/info');
                    
                    echo "Send agent request status to ProxmoxAPI \n";
                    if(isset($result["data"])) {
                        if ($result["data"] != "") {
                            $agentNotRunning = false;
                        }
                    }
                }
                $ipData = json_decode($queueDataStorage["ipData"],true);
                $execData = [
                    "command" => 'netsh interface ip set address "Ethernet" static '.$ipData["ipV4"][0]["ip"].' 255.255.255.0 '.$ipData["ipV4Subnet"][$ipData["ipV4"][0]["subnet"]]["gw"]
                ];
                $proxmoxClient->create('/nodes/' . $nodeData["name"] .'/qemu/'.$vserverData["proxmoxid"].'/agent/exec', $execData);
                if(isset($ipData["ipV6"][0]["netmask"])){
                    $execData = [
                        "command" => 'netsh interface ipv6 set address "Ethernet" address=' . $ipData["ipV6"][0]["netmask"] . '/64 store=persistent'
                    ];
                    $proxmoxClient->create('/nodes/' . $nodeData["name"] .'/qemu/'.$vserverData["proxmoxid"].'/agent/exec', $execData);
    
                    $execData = [
                        "command" => 'netsh interface ipv6 delete address "Ethernet" address=2a00::1'
                    ];
                    $proxmoxClient->create('/nodes/' . $nodeData["name"] .'/qemu/'.$vserverData["proxmoxid"].'/agent/exec', $execData);
                }
                $execData = [
                    "command" => 'NET USER administrator ' . $vserverData["firstpw"]
                ];
                $proxmoxClient->create('/nodes/' . $nodeData["name"] .'/qemu/'.$vserverData["proxmoxid"].'/agent/exec', $execData);

                $execData = [
                    "command" => 'slmgr -rearm'
                ];
                $proxmoxClient->create('/nodes/' . $nodeData["name"] .'/qemu/'.$vserverData["proxmoxid"].'/agent/exec', $execData);

                $result["data"] = "";
                break;
            case 'config':
                $repeatTime = 200000;
                $proxmoxClient->set('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/resize', [
                    "disk" => "scsi0",
                    "size" => $vserverData["disk"] . 'G',
                ]);
                $ipData = json_decode($queueDataStorage["ipData"],true);
                if(isset($ipData["ipV6"][0]["gw"])){
                    $info = [
                        'cores' => $vserverData["cores"],
                        'memory' => $vserverData["memory"],
                        'cipassword' => $vserverData["firstpw"],
                        'ciuser' => 'root',
                        'net0' => 'virtio=' . $vserverData["mac"] . ',bridge=vmbr0,rate=90,firewall=1',
                        'ipconfig0' => 'gw=' . $ipData["ipV4Subnet"][$ipData["ipV4"][0]["subnet"]]["gw"] . ',ip=' . $ipData["ipV4"][0]["ip"] . '/24,gw6=' . $ipData["ipV6"][0]["gw"] . ',ip6=' . $ipData["ipV6"][0]["netmask"] . '/64'
                    ];
                } else {
                    $info = [
                        'cores' => $vserverData["cores"],
                        'memory' => $vserverData["memory"],
                        'cipassword' => $vserverData["firstpw"],
                        'ciuser' => 'root',
                        'net0' => 'virtio=' . $vserverData["mac"] . ',bridge=vmbr0,rate=90,firewall=1',
                        'ipconfig0' => 'gw=' . $ipData["ipV4Subnet"][$ipData["ipV4"][0]["subnet"]]["gw"] . ',ip=' . $ipData["ipV4"][0]["ip"] . '/24'
                    ];
                }
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/config', $info);
                $proxmoxClient->set('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/firewall/options', [
                    "enable" => 1,
                    "policy_out" => "DROP",
                    "policy_in" => "DROP",
                ]);

                $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/firewall/ipset', [
                    "name" => "vm" . $vserverData["proxmoxid"]
                ]);

                foreach ($ipData["ipV4"] as $ip){
                    $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/firewall/ipset/' . "vm" . $vserverData["proxmoxid"], [
                        "cidr" => $ip["ip"] . "/32"
                    ]);
                }

                foreach ($ipData["ipV6"] as $ip){
                    $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/firewall/ipset/' . "vm" . $vserverData["proxmoxid"], [
                        "cidr" => $ip["netmask"] . "/64"
                    ]);
                }

                $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/firewall/rules', [
                    "action" => 'ACCEPT',
                    "type" => "out",
                    "enable" => "1",
                    "source" => "+vm" . $vserverData["proxmoxid"]
                ]);

                $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/firewall/rules', [
                    "action" => 'ACCEPT',
                    "type" => "in",
                    "enable" => "1",
                    "dest" => "+vm" . $vserverData["proxmoxid"]
                ]);
                break;
            case 'changeCPUType':
                $repeatTime = 200000;
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/config', [
                    "cpu" => $queueDataStorage["cpuType"],
                ]);
                echo "Send cpu type change request to ProxmoxAPI \n";
                break;
            case 'migrateToBestNode':
                $repeatTime = 500000;
                $result = $proxmoxClient->create('/nodes/' . $nodeData["name"] . '/qemu/' . $vserverData["proxmoxid"] . '/migrate', [
                    "target" => $queueDataStorage["targetNode"],
                ]);
                echo "Send migrate request to ProxmoxAPI Target: " . $queueDataStorage["targetNode"] . "\n";
                break;
            default:
                die("No valid action" .$taskEntry["action"]);
        }
        if(!isset($result["data"])){
            sendDataToDiscordFeed($config["discordURL"], "Task exec error", "Proxmox Task no ProxmoxTaskID", "https://prohosting24.de", [[
                "name" => "ProxmoxID",
                "value" => $vserverData["proxmoxid"]
            ]]);
            $database->update('vserver_queue_tasks', [
                "status" => 3
            ], [
                "id" => $taskEntry["id"]
            ]);
            $msg->ack();
            $error = true;
            break;
        }
        $taskId = $result["data"];
        if($taskId != "") {
            $running = true;
            while ($running) {
                usleep($repeatTime);
                $status = $proxmoxClient->get('/nodes/' . $nodeData["name"] . '/tasks/' . $taskId . '/status');
                
                echo "Send status request to ProxmoxAPI \n";
                if (isset($status["data"]["status"])) {
                    if ($status["data"]["status"] == "stopped") {
                        if ($status["data"]["exitstatus"] != "OK") {
                            switch ($taskEntry["action"]) {
                                case 'shutdown':
                                    break 3;
                                default:
                                    break;
                            }
                            sendDataToDiscordFeed($config["discordURL"], "Task exec error", "Proxmox Task returned an error", "https://prohosting24.de", [[
                                "name" => "ProxmoxTaskID",
                                "value" => $status["data"]["upid"]
                            ], [
                                "name" => "ProxmoxID",
                                "value" => $status["data"]["id"]
                            ], [
                                "name" => "ExitStatus",
                                "value" => $status["data"]["exitstatus"]
                            ], [
                                "name" => "NodeName",
                                "value" => $status["data"]["node"]
                            ]]);
                            $database->update('vserver_queue_tasks', [
                                "status" => 3
                            ], [
                                "id" => $taskEntry["id"]
                            ]);
                            $msg->ack();
                            $error = true;
                            break 2;
                        }
                        switch ($taskEntry["action"]) {
                            case 'migrateToBestNode':
                                $nodeData["name"] = $queueDataStorage["targetNode"];
                                $database->update('vserver_main', [
                                    "nodeid" => $queueDataStorage["targetNodeId"]
                                ], [
                                    "id" => $vserverData["id"]
                                ]);
                                break;
                            case 'create':
                                $nodeData["name"] = $nodeData["nameNormal"];
                                break;
                            default:
                                break;
                        }
                        $running = false;
                    }
                }
            }
        }
        $database->update('vserver_queue_tasks', [
            "status" => 2
        ],[
            "id" => $taskEntry["id"]
        ]);
    }
    if($error){
        $database->update('vserver_queue', [
            "status" => 3
        ],[
            "id" => $queueData["id"]
        ]);
        return;
    }
    echo "Finish work on queue entry " . $queueData["id"] ." with " . count($taskList) . " tasks (VM " . $queueData["vserverid"] . "). \n";
    $database->update('vserver_queue', [
        "status" => 2
    ],[
        "id" => $queueData["id"]
    ]);
    $msg->ack();
};


$channel->basic_qos(null, 1, null);
$channel->basic_consume('ph24_vserver', '', false, false, false, false, $callback);
echo " [*] Waiting for messages. To exit press CTRL+C\n";
while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();