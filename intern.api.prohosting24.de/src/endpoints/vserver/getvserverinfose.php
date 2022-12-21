<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!isset($_GET["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
header('X-Accel-Buffering: no');
header("Cache-Control: no-cache");

$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
if ($browser == 'Firefox') {
    header("Content-Type: text/event-stream");
} else {
    header("Content-Type: text/event-stream\n\n");
}



while (true) {
    $apirespond = requestBackend($config, ["id" => $_GET["id"]], "getvserverinfos");
    if ($apirespond["response"]["userid"] != $user->getID()) {
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    echo "\n\n";
    echo 'data: ' . json_encode($apirespond["response"]);
    set_time_limit(0);
    ob_flush();
    flush();
    sleep(4);
}
