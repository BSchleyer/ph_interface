<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$groups = $masterdatabase->select("main_groups", [
    "id",
    "name",
    "created_on",
]);

$response->setresponse($groups);
