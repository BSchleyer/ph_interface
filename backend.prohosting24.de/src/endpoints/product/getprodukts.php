<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$produkts = $masterdatabase->select("product_main", [
    "id",
    "typid",
    "name",
    "price",
    "config",
    "created_on",
]);

$response->setresponse($produkts);
