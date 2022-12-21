<?php


class VServerQueueController extends RouteTarget
{
    public function checkTaskStatus()
    {
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["status" => 1]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $status = $vServer->checktaskdb($queueEntry->getValue("taskid"), $queueEntry->getValue("nodename"));
            if($status == null){
                continue;
            }
            if($status){
                $queueEntry->setValue("status", 2);
                $queueEntry->update();
                $queueEntry->createNextTask();
            }
        }
    }

    public function start()
    {
        $queueId = 1;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->start();
            $queueEntry->processResult($task);
        }
    }

    public function stop()
    {
        $queueId = 2;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->stop();
            $queueEntry->processResult($task);
        }
    }

    public function shutdown()
    {
        $queueId = 3;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->shutdown();
            $queueEntry->processResult($task);
        }
    }

    public function delete()
    {
        $queueId = 4;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->delete();
            $queueEntry->processResult($task);
        }
    }

    public function installStep1()
    {
        $queueId = 5;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->install(1);
            $queueEntry->processResult($task);
        }
    }

    public function installStep2()
    {
        $queueId = 6;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->install(2);
            if($task == "migrateError"){
                $queueEntry->setValue("status", 2);
                $queueEntry->update();
                $queue = new VServerQueue($this->dependencyInjector, null);
                $queue->setValue("serviceid", $queueEntry->getValue("serviceid"));
                $queue->setValue("nextid", "6,".$queueEntry->getValue("nextid"));
                $queue->setValue("action", "7");
                $queue->create();
                continue;
            }
            $queueEntry->processResult($task);
        }
    }

    public function migrateServer()
    {
        $queueId = 7;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->migratetoBestNode();
            $queueEntry->setValue("nodename", $vServer->getNodeauth()["name"]);
            $queueEntry->processResult($task);
        }
    }

    public function applyConfig()
    {
        $queueId = 8;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->reApplyConfig();
            $queueEntry->processResult($task);
        }
    }

    public function backupCreate()
    {
        $queueId = 9;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueListRunning = $queue->getAll(["action" => $queueId, "status" => 1]);
        if(count($queueListRunning) != 0){
            return;
        }
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->createBackupV();
            $queueEntry->processResult($task);
            die();
        }
    }

    public function backupDelete()
    {
        $queueId = 10;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueListRunning = $queue->getAll(["action" => $queueId, "status" => 1]);
        if(count($queueListRunning) != 0){
            return;
        }
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $vServer->deletebackupCron($queueEntry->getValue("data"));
            $queueEntry->setValue("status", 2);
            $queueEntry->update();
            $queueEntry->createNextTask();
            die();
        }
    }

    public function backupRedeploy()
    {
        $queueId = 11;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueListRunning = $queue->getAll(["action" => $queueId, "status" => 1]);
        if(count($queueListRunning) != 0){
            return;
        }
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->backupeinspielen($queueEntry->getValue("data"));
            $queueEntry->processResult($task);
            die();
        }
    }

    public function reset()
    {
        $queueId = 12;
        $queue = new VServerQueue($this->dependencyInjector, null, null);
        $queueList = $queue->getAll(["action" => $queueId, "status" => 0]);
        foreach ($queueList as $queueEntry){
            $vServer = new VServer($this->dependencyInjector);
            $vServer->loadwithid($queueEntry->getValue("serviceid"));
            $task = $vServer->reset();
            $queueEntry->processResult($task);
        }
    }

    public function calcHourly()
    {
        $currenttime = date('Y-m-d H:i:s', time());
        $serviceinfos = $this->dependencyInjector->getDatabase()->select("service_main", [
            "id",
            "produktid"
        ], [
            "expire_at[<]" => $currenttime,
            "delete_at" => null,
            "hourly" => 1
        ]);
        foreach ($serviceinfos as $service) {
            $service = new Service($this->dependencyInjector, $service["id"]);
            $service->calcHourly();
            $service->setValue("expire_at", date('Y-m-d H:i:s', strtotime('+1 hours')));
            $service->update();
        }
    }
}