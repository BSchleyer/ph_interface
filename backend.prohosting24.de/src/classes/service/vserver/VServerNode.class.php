<?php


namespace Ph24\service;

use BaseDatabase;
use Functions;
use ProxmoxVE\Proxmox;
use Syslog;

class VServerNode extends BaseDatabase
{

    private Proxmox $proxmoxClient;

    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_nodes", $dependencyInjector, $value, $key);
    }

    public function loadClient()
    {
        if(isset($this->proxmoxClient)){
            return;
        }
        try {
            $credentials = [
                'hostname' => $this->getValue("hostname"),
                'username' => $this->getValue("username"),
                'password' => \Functions::encrypt_decrypt("decrypt", $this->getValue("password"), $this->dependencyInjector->getConfig()->getconfigvalue("key"), $this->dependencyInjector->getConfig()->getconfigvalue("key")),
                'realm' => 'pve',
            ];
            $this->proxmoxClient = new Proxmox($credentials);
        } catch (\Exception $error) {
            Functions::errorLog("proxmoxError", "Error while connecting to Node", ["node" => $this->getValue("id")]);
            $this->dependencyInjector->getNewResponse()->failPostInit(500, $this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
        }
    }

    public function fsTrimWindows($id)
    {
        $this->loadClient();
        
        $result = $this->proxmoxClient->create('/nodes/' . $this->getValue("name") . '/qemu/' . $id . '/agent/fstrim');
    }

    public function getBestNode()
    {
        $this->loadClient();
        $response = $this->proxmoxClient->get('/nodes/');
        if(isset($response["data"])){
            $node = new VServerNode($this->dependencyInjector, null);
            $nodeList = $node->getAll(["active" => 1], true);
            $nodeListTmp = [];
            foreach ($nodeList as $node){
                $nodeListTmp[$node["name"]] = $node;
            }

            $nodeList = $nodeListTmp;

            $currentBestRam = 0;
            $currentBestCpu = 0;
            $currentBestRamNode = "";
            $currentBestCpuNode = "";
            $currentBestRamNodePercent = "";
            $currentBestRamPercent = 0;
            foreach ($response["data"] as $node){
                if(!isset($nodeList[$node["node"]])){
                    continue;
                }
                $nodeFreeRam = $node["mem"] - $node["maxmem"];
                $nodePercentRam = $node["mem"] / $node["maxmem"];
                if($currentBestRam == 0){
                    $currentBestRam = $node["mem"];
                    $currentBestCpu = $node["cpu"];
                    $currentBestRamNode = $node["node"];
                    $currentBestRamNodePercent = $node["node"];
                    $currentBestRamPercent = $nodePercentRam;
                    $currentBestCpuNode = $node["node"];
                }
                if($nodeFreeRam < $currentBestRam){
                    $currentBestRam = $nodeFreeRam;
                    $currentBestRamNode = $node["node"];
                }
                if($nodePercentRam < $currentBestRamPercent){
                    $currentBestRamPercent = $nodePercentRam;
                    $currentBestRamNodePercent = $node["node"];
                }
                if($node["cpu"] < $currentBestCpu){
                    $currentBestCpu = $node["cpu"];
                    $currentBestCpuNode = $node["node"];
                }
            }
            $log = new Syslog($this->dependencyInjector, null);
            $log->log("vserverNodeSelect", [
                "rawProxmoxData" => $response,
                "selectedInfo" => [
                    "currentBestRam" => $currentBestRam,
                    "currentBestRamNode" => $currentBestRamNode,
                    "currentBestCpu" => $currentBestCpu,
                    "currentBestCpuNode" => $currentBestCpuNode,
                    "currentBestRamNodePercent" => $currentBestRamNodePercent,
                    "currentBestRamPercent" => $currentBestRamPercent
                ]
            ]);
        } else {
            return $this->getBestNode();
        }
        return $currentBestRamNodePercent;
    }

    public function getKVMCurrentStatus($id)
    {
        $this->loadClient();
        return $this->proxmoxClient->get('/nodes/' . $this->getValue("name") . '/qemu/' . $id . '/status/current');
    }

    public function getQemuStats()
    {
        $this->loadClient();
        return $this->proxmoxClient->get('/nodes/' . $this->getValue("name") . '/qemu');
    }

}