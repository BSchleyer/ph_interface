<?php



function getcountfromdatabase($masterdatabase, $table, $row, $string)
{
    $count = $masterdatabase->count($table, [
        $row . "[=]" => $string,
    ]);
    return $count;
}

function flipip($ip)
{
    $ipa = explode(":", $ip);
    if (count($ipa) == 1) {
        $ip = explode(".", $ip);
        $ip = $ip[3] . "." . $ip[2] . "." . $ip[1] . "." . $ip[0];
        return $ip;
    }
    if (count($ipa) == 6) {
        $ipa = explode("::", $ip);
        $ipa = $ipa[0] . ":0:0:0:" . $ipa[1];
        $ipa = explode(":", $ipa);
    }
    $newip = "";
    foreach ($ipa as $key => $value) {
        
        while (strlen($value) < 4) {
            $value = "0" . $value;
        }
        $newip = $newip . "." . $value[0] . "." . $value[1] . "." . $value[2] . "." . $value[3];
    }
    $newip = explode(".", $newip);
    $newipr = "";
    foreach (array_reverse($newip) as $key => $value) {
        $newipr = $newipr . "." . $value;
    }
    return substr(substr($newipr, 1), 0, -1);
}

function encrypt_decrypt($action, $string, $secret_key, $secret_iv)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    
    $key = hash('sha256', $secret_key);

    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function sendtodc($message, $config)
{
    $webhookurl = $config->getconfigvalue('discord_feed_channel');
    $msg = $message;
    $json_data = array('content' => "$msg");
    $make_json = json_encode($json_data);
    $ch = curl_init($webhookurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $make_json);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
}

function niceDate($time){
    $time = date('H:i:s d.m.Y', strtotime($time));
    return $time;
}

function niceNumber($number){
    return str_replace(".", ",", $number);
}


function checkString($string, $allowed = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"){
    $allowed = str_split($allowed);
    $linkSplit = str_split($string);
    $out = "";
    foreach ($linkSplit as $entry) {
        if(in_array($entry,$allowed)){
           $out .= $entry; 
        }
    }
    return $out;
}