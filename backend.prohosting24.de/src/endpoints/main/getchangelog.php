<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$changelog = $masterdatabase->select("main_changelog", [
    "id",
    "header",
    "content",
    "created_on",
], [
    "ORDER" => ["id" => "DESC"],
    "LIMIT" => 5,
]);

foreach ($changelog as $key => $entry) {
    $changelog[$key]["created_on"] = niceDate($entry["created_on"]);
}

$response->setresponse($changelog);