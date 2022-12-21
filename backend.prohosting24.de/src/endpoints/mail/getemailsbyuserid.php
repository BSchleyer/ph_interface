<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$mail = new Mail($masterdatabase, $config);

$maillist = $mail->getemailsbyuserid($_POST["userid"]);

$return = [];

foreach ($maillist as $key => $entry) {
    if(isset($_POST["limit"])){
        if(count($return) > $_POST["limit"]){
            break;
        }
    }
    $return[$key] = $entry;
    if(isset($entry["data"])){
        $data = json_decode($entry["data"], true);
        if(!is_array($data)){
            $data = [];
        }
    } else {
        $data = [];
    }
    $return[$key]["title"] = $mail->convertEmailContent($return[$key]["title"], $data, $dependencyInjector);

    $return[$key]["created_on"] = niceDate($entry["created_on"]);
}

$response->setresponse($return);
