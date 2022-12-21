<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

if (isset($content[1])) {
    $invoice = requestBackend($config, ["invoice" => $content[2], "userid" => $user->getId()], "invoiceGetDetailsPDF", $user->getLang());
    if(!isset($invoice["response"])){
        header('Location: ' . $url);
        die();
    }
} else {
    header('Location: ' . $url);
    die();
}
header("Content-type:application/pdf");
echo base64_decode($invoice["response"]);