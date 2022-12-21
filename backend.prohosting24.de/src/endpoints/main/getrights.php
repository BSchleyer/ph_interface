<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$rights = $masterdatabase->select("main_rights", [
    "id",
    "name",
    "created_on",
]);

$response->setresponse($rights);
