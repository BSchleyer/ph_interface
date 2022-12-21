<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$vserver = $masterdatabase->select("vserver_main", [
    "id",
    "nodeid",
    "cores",
    "memory",
    "disk",
    "firstpw",
    "trafficlimit",
    "mac",
    "imageid",
    "proxmoxid",
    "created_on",
]);

$response->setresponse($vserver);
