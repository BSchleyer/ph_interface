<?php


defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid", "password_old","password_new","password_new2"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$user = new User();
$user->load_id($masterdatabase,$_POST["userid"]);

if(!$user->checkpassword($_POST["password_old"])){
    $dependencyInjector->getResponse()->fail(200, "Das alte Passwort ist falsch");
}

if($_POST["password_new"] != $_POST["password_new2"]){
    $dependencyInjector->getResponse()->fail(200, "Das wiederholte Passwort ist falsch");
}

if($_POST["password_new"] == " " || strlen($_POST["password_new"]) < 5){
    $dependencyInjector->getResponse()->fail(200, "Das Passwort erfüllt nicht die Anforderungen.");
}

$user->updatePassword($_POST["password_new"], $masterdatabase);