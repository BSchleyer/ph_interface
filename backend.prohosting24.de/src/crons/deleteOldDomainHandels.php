<?php



$domain = new Domain($dependencyInjector->getDatabase(), $dependencyInjector->getConfig());

$handelsAPI = $domain->getAllHandelsFromApi();

$handelsDB = $domain->getAllHandelsFromDb();

$handelsApiFormated = [];

foreach ($handelsAPI["data"]["handles"] as $handle) {
    $result = $domain->deleteHandle($handle["handle"]);
    $handelsApiFormated[$handle["handle"]] = $handle;
}

foreach ($handelsDB as $handle){
    if(!isset($handelsApiFormated[$handle["handle"]])){
        $domain->deleteHandleDB($handle["id"]);
    }
}

