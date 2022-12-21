<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$history = $masterdatabase->select("main_log_credit", [
    "id",
    "change",
    "reason",
    "created_on",
], [
    "userid" => $_POST["userid"],
]);


foreach ($history as $key => $entry) {
    $history[$key]["created_on"] = niceDate($entry["created_on"]);
    $history[$key]["change"] = number_format(round(str_replace("++", "+", $entry["change"]), 2), 2,',','') . " €";
}


$response->setresponse($history);
