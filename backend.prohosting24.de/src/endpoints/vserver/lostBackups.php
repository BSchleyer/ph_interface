<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();



$serviceinfos = $masterdatabase->select("service_main", [
    "id",
    "produktid",
    "serviceid",
], [
    "delete_done" => 0,
    "produktid" => 1
]);

$vserver = New VServer($dependencyInjector);

$vserver->loadwithid($serviceinfos[0]["serviceid"]);

$backups = $vserver->getallbackups();

foreach ($serviceinfos as $vservers) {
    foreach ($backups as $key => $backup) {
        if (strpos($backup["volid"], 'vzdump-qemu-' . $vservers["serviceid"]) !== false) {
            unset($backups[$key]);
        }
    }
}

foreach ($backups as $key => $backup) {
    if (strpos($backup["volid"], 'qcow2') !== false) {
        unset($backups[$key]);
    }
    if (strpos($backup["volid"], '.raw') !== false) {
        unset($backups[$key]);
    }
    if (strpos($backup["volid"], '.iso') !== false) {
        unset($backups[$key]);
    }
    if (strpos($backup["volid"], '.ISO') !== false) {
        unset($backups[$key]);
    }
    if(isset($backup["vmid"])){
        if($backup["vmid"] < 1000){
            unset($backups[$key]);
        }
    }
}


foreach ($backups as $backup) {
    $vserver->deletebackup($backup["volid"]);
}

$response->setresponse($backups);