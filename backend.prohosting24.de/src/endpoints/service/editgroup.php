<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "name", "groupid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$group = new ServiceGroup($dependencyInjector, $_POST["groupid"]);

if($group->getValue("userid") != $_POST["userid"]){
    $response->setfail(true, $dependencyInjector->getLang()->getString("groupnotowner"));
    return;
}

if(strlen($_POST["name"]) < 1){
    $response->setfail(true, $dependencyInjector->getLang()->getString("groupnoname"));
    return;
}

if(strlen($_POST["name"]) > 64){
    $response->setfail(true, $dependencyInjector->getLang()->getString("groupmax64"));
    return;
}

$group->setValue("displayname",  htmlspecialchars(preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $_POST["name"])));
$group->update();

$response->setresponse($group->getValue("id"));