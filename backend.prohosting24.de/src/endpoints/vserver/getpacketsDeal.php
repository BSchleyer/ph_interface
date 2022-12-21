<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$packages = new VServerPacket($masterdatabase, $config);
$response->setresponse($packages->getbyNormal());
