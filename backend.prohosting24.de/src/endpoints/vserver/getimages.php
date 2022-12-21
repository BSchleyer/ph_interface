<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$images = $masterdatabase->select("vserver_images", [
    "id",
    "intern_id",
    "name",
    "icon",
    "created_on",
], [
    "ORDER" => ["name" => "ASC"],
]);

$response->setresponse($images);
