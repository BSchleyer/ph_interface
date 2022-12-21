<?php


require_once __DIR__ . '/vendor/autoload.php';


$config = json_decode(file_get_contents('config.json'), true);

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

$connection = new AMQPStreamConnection($config["rabbitMq"]["host"], $config["rabbitMq"]["port"], $config["rabbitMq"]["username"], $config["rabbitMq"]["password"]);
$channel = $connection->channel();

$channel->queue_declare('ph24_database', false, true, false, false);



$callback = function ($msg) {
    global $database;
    $message = json_decode($msg->body, true);
    echo "Insert entry in table: " . $message["tableName"] . "\n";
    switch ($message["type"]) {
        case "insert":
            $database->insert($message["tableName"], $message["values"]);
            if(isset($database->error)){
                print_r($database->error);
            }
        break;
        default:
            echo "Unknown type: " . $message["type"] . "\n";
        break;
    }
    $msg->ack();
};


$channel->basic_qos(null, 1, null);
$channel->basic_consume('ph24_database', '', false, false, false, false, $callback);
echo " [*] Waiting for messages. To exit press CTRL+C\n";
while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();