<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "name", "title", "data", "date_nohtml"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$mail = new Mail($masterdatabase, $config);

$mail->updatetemplate($_POST["id"], $_POST["name"], $_POST["title"], $_POST["data"], $_POST["date_nohtml"]);
