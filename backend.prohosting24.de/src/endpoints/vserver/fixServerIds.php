<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


$node = new Node($dependencyInjector);
$nodes = $node->getall($masterdatabase);

foreach ($nodes as $node){
    $node = new Node($dependencyInjector);
    $node->load_id($masterdatabase, $node["id"]);

    $servers = $node->getAllServers();
}