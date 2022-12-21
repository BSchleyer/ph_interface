<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$packages = new VServerPacket($masterdatabase, $config);
if (isset($_POST["id"])) {
    $response->setresponse($packages->getbyida($_POST["id"]));
} else {
    $response->setresponse($packages->getall());
}
