<?php


require_once __DIR__ . '/vendor/autoload.php';


$config = json_decode(file_get_contents('config.json'), true);

global $config;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PHPMailer\PHPMailer\PHPMailer;

$connection = new AMQPStreamConnection($config["rabbitMq"]["host"], $config["rabbitMq"]["port"], $config["rabbitMq"]["username"], $config["rabbitMq"]["password"]);
$channel = $connection->channel();

$channel->queue_declare('ph24_mail', false, true, false, false);

$callback = function ($msg) {
    global $config;
    $message = json_decode($msg->body, true);


    echo "Send new Mail \n";
    echo $message["mail"] . " " . $message["name"] . "\n";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host = $config["mail"]["server"];
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->MessageID = $message["MessageID"];
    $mail->Port = $config["mail"]["port"];
    $mail->Username = $config["mail"]["user"];
    $mail->Password = $config["mail"]["password"];
    $mail->setFrom($config["mail"]["user"], 'ProHosting24');
    $mail->addAddress($message["mail"], $message["name"]);
    $mail->addReplyTo('info@prohosting24.de', 'ProHosting24');

    
    $mail->isHTML(true);
    $mail->Subject = $message["title"];
    $mail->Body = $message["body"];
    $mail->AltBody = $message["bodyNoHtml"];

    $mail->send();
    $msg->ack();
    
    sleep(3);
};


$channel->basic_qos(null, 1, null);
$channel->basic_consume('ph24_mail', '', false, false, false, false, $callback);
echo " [*] Waiting for messages. To exit press CTRL+C\n";
while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();