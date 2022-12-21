<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid", "name"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$group = new ServiceGroup($dependencyInjector, null);

$groupList = $group->getAll(["userid" => $_POST["userid"]], true);

if(count($groupList) > 11){
    $response->setfail(true, $dependencyInjector->getLang()->getString("grouplimitreached"));
    return;
}

$group->setValue("userid", $_POST["userid"]);

if(strlen($_POST["name"]) < 1){
    $response->setfail(true, $dependencyInjector->getLang()->getString("groupnoname"));
    return;
}

if(strlen($_POST["name"]) > 64){
    $response->setfail(true, $dependencyInjector->getLang()->getString("groupmax64"));
    return;
}

$group->setValue("displayname",  htmlspecialchars(preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $_POST["name"])));
$group->create();

$response->setresponse($group->getValue("id"));