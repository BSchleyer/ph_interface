<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;



class VServerQueueNew extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_queue", $dependencyInjector, $value, $key);
    }

    public function checkQueue($vserverId)
    {
        $queueList = $this->getAll(["vserverid" => $vserverId, "status" => 0]);
        if(count($queueList) != 0){
            return false;
        }
        return true;
    }

    public function getTaskList($queueId)
    {
        $taskList = new VServerQueueTask($this->dependencyInjector, null);
        return $taskList->getAll(["queueid" => $queueId, "ORDER" => ["id" => "ASC"]], true);
    }

    public function getQueue($vserverId)
    {
        $queueList = $this->getAll(["vserverid" => $vserverId, "status" => [0,1,3]], true);
        if(count($queueList) == 0){
            return [];
        }
        $queueList = $queueList[0];
        $queueList["tasks"] = $this->getTaskList($queueList["id"]);
        return $queueList;
    }

    public function createRabbitMQ()
    {
        $data = [
            "id" => $this->getValue("id")
        ];
        $connection = new AMQPStreamConnection($this->dependencyInjector->getConfig()->getconfigvalue("rabbitmq")["ip"],
            $this->dependencyInjector->getConfig()->getconfigvalue("rabbitmq")["port"],
            $this->dependencyInjector->getConfig()->getconfigvalue("rabbitmq")["username"],
            $this->dependencyInjector->getConfig()->getconfigvalue("rabbitmq")["password"],
        );
        $channel = $connection->channel();

        $channel->queue_declare('ph24_vserver', false, true, false, false);

        $msg = new AMQPMessage(json_encode($data));
        $channel->basic_publish($msg, '', 'ph24_vserver');
    }

    public function newTask($vserverId, $taskList, $data = [])
    {
        if(!$this->checkQueue($vserverId)){
            return false;
        }

        $queueEntry = new VServerQueueNew($this->dependencyInjector, null);
        $queueEntry->setValue("vserverid", $vserverId);
        $queueEntry->create();

        foreach ($taskList as $task) {
            $queueTask = new VServerQueueTask($this->dependencyInjector, null);
            $queueTask->setValue("queueid", $queueEntry->getValue("id"));
            $queueTask->setValue("action", $task);
            $queueTask->create();
        }

        foreach ($data as $dataKey => $dataValue) {
            $queueData = new VServerQueueData($this->dependencyInjector, null);
            $queueData->setValue("queueid", $queueEntry->getValue("id"));
            $queueData->setValue("key", $dataKey);
            $queueData->setValue("value", $dataValue);
            $queueData->create();
        }
        $queueEntry->createRabbitMQ();

        return $queueEntry;
    }
}