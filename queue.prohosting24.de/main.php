<?php


require_once 'src/classes/AutoClassLoader.class.php';
new AutoClassLoader();

$config = new ConfigReader("src/configs/config.json");

Functions::$backendKey = $config->getconfigvalue("backendapikey");
Functions::$backendUrl = $config->getconfigvalue("backendendpoint");
Functions::$config = $config;

$queueManager = new QueueManager();
while (true){
    $queueManager->setQueueCounter($queueManager->getQueueCounter() + 1);
    $queueManager->doQueue();
    if($queueManager->getQueueCounter() > 10){
        $queueManager->setQueueCounter(0);
    }
    sleep(1);
}