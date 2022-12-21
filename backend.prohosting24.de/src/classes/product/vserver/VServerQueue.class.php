<?php


class VServerQueue extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_queue_new", $dependencyInjector, $value, $key);
    }

    public function createNextTask()
    {
        if($this->getValue("nextid") != 0){
            $tasks = explode(",",$this->getValue("nextid"));
            $newTask = new VServerQueue($this->dependencyInjector, null);
            $newTask->setValue("serviceid", $this->getValue("serviceid"));
            $newTask->setValue("action", $tasks[0]);
            $newTask->setValue("data", $this->getValue("data"));
            unset($tasks[0]);
            if(count($tasks) != 0){
                $newTask->setValue("nextid", implode(",", $tasks));
            }
            $newTask->create();
        }
    }

    public function processResult($result)
    {
        if($result == "done"){
            $this->setValue("status", 2);
            $this->update();
            $this->createNextTask();
            return;
        }
        if($result == null){
            return;
        }
        $this->setValue("taskid", $result["data"]);
        $this->setValue("status", 1);
        $this->update();
    }
}
