<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["groupid"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}



$rights = $masterdatabase->select("main_rights", [
    "id",
    "name",
]);


$rightstogroup = $masterdatabase->select("main_group_to_rights", [
    "rightid",
], [
    "groupid" => $_POST["groupid"],
]);


$rightstogroupS = [];
foreach ($rightstogroup as $right) {
    array_push($rightstogroupS, $right["rightid"]);
}
for ($i = 0; $i < count($rights); $i++) {
    if (in_array($rights[$i]["id"], $rightstogroupS)) {
        $rights[$i]["has"] = 1;
    }
}

$response->setresponse($rights);
