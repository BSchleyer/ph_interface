<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');


if(isset($content[1])){
    if($content[1] == ""){
        $router->sendclient("404", $router, $config, $content, $user,$lang);
        die();
    }
	$donationLinkInfo = requestBackend($config, ["name" => $content[1]], "getDonationLinkByName", $user->getLang());
    if(isset($donationLinkInfo["error"])){
        $router->sendclient("404", $router, $config, $content, $user,$lang);
        die();        
    }
    requestBackend($config, ["name" => $content[1], "ip" => getclientip()], "addDonationLinkClick", $user->getLang());
    $donationLinkInfo = $donationLinkInfo["response"];
    require_once 'donateDisplay.php';
    die();
}
$router->sendclient("404", $router, $config, $content, $user,$lang);
die();