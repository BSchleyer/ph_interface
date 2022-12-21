<?php


class Functions
{
    public static $backendUrl = "";
    public static $backendKey = "";
    public static ConfigReader $config;

    public static function sendRequest($function, $data)
    {
        $post_url = http_build_query($data);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => Functions::$backendUrl,
            CURLOPT_USERAGENT => 'ProHosting24 QueueWorker',
            CURLOPT_POST => 1,
        ]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Function: ' . $function,
            'key: ' . Functions::$backendKey,
        ));
        $res = curl_exec($curl);
        $apirespond = json_decode($res, true);
        curl_close($curl);
        return $apirespond;
    }

    public static function printConsole($message)
    {
        echo "\033[32m[" . date('d-m-Y h:i:s', time()) . "] \033[0m" . $message . "\n";
    }

    public static function sendtodc($message)
    {
        $ch = curl_init(Functions::$config->getconfigvalue('discord_feed_channel'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['content' => "$message"]));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($ch);
    }
}