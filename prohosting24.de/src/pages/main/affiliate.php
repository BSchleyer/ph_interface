<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();
$url = $config->getconfigvalue('url');

if(!isset($content[1])){
    header('Location: ' . $url);
    die();
}


$apirespond = requestBackend($config, ["ip" => getclientip(),"link" => $content[1],"url" => "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ], "linkclick");

if($apirespond["fail"] == 500){
    
    header('Location: ' . $url);
    die();
}

if(!isset($content[2])){
    $content[2] = "";
}
setcookie("ph24_affiliate",$apirespond["response"],strtotime( '+90 days' ),"/");

switch ($content[2]) {
    case 1:
        header('Location: ' . $url . "/vserver");
        die();
    case 2:
        header('Location: ' . $url . "/vserverpakete");
        die();
    case 3:
        header('Location: ' . $url . "/webspace");
        die();
    case 4:
        header('Location: ' . $url . "/domains");
        die();
    default:
        
        header('Location: ' . $url);
        die();
}
die();