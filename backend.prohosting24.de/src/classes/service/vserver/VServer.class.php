<?php


namespace Ph24\service;

use VServerQueueNew;

class VServer extends Service
{

    private VServerNode $node;

    public function __construct($dependencyInjector, $value, $type)
    {
        parent::__construct($dependencyInjector, $value, $type, "vserver_main", 1);
    }

    public function trimQueueTask(\VServerQueueNew $queue)
    {
        return $queue->getQueue($queue->getValue("vserverid"));
    }

    public function getQueueInfo()
    {
        $queueEntry = new \VServerQueueNew($this->dependencyInjector, null);
        $queueList = $queueEntry->getAll(["vserverid" => $this->getValue("serviceid"), "status[!]" => 2]);
        if(count($queueList) != 1){
            return null;
        }
        return $this->trimQueueTask($queueList[0]);
    }

    public function getServiceInfo()
    {
        $vServerData = \Functions::convertTimeToUnix(\Functions::removeData($this->childInfo,["trafficlimit","mac","apitoken","ipv6max"]),["created_on"]);
        $serviceData = parent::getServiceInfo();
        $proxmoxData = $this->getProxmoxData();
        if(is_a($proxmoxData, Vserver::class)){
            return $this;
        }
        $proxmoxData = \Functions::removeData($proxmoxData,["blockstat","proxmox-support","ha","netout","template","serial","agent","disk","diskread","diskwrite","netin","pid","running-machine","running-qemu","qmpstatus","maxmem","ballooninfo","nics","maxdisk","balloon","mem","name","cpus","vmid"]);
        $queueData = $this->getQueueInfo();

        $vServerData["proxmoxid"] = intval($vServerData["proxmoxid"]);

        $serviceData["productid"] = $serviceData["produktid"];
        unset($serviceData["produktid"]);

        return [
            "service" => $serviceData,
            "vserver" => $vServerData,
            "proxmox" => $proxmoxData,
            "queue" => $queueData
        ];
    }

    public function stop()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }

        if($proxmoxData["data"]["status"] == "stopped") {
            
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("vserverallreadstopped"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        $task = $this->createTask(["stop"]);
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function restart()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        if($this->getChildValue("nodelock") == 0) {
            $bestNode = $this->getBestNode();
        } else {
            $bestNode = $this->node->getValue("name");
        }
        $cputype = "";
        if($this->getChildValue('cputype') != 'cputype'){
            $cputype = $this->getChildValue('cputype');
        }

        if($bestNode == $this->node->getValue("name")){
            if($cputype == ""){
                $cputype = $this->node->getValue('defaultcputype');
            }
            $task = $this->createTask(["stop","changeCPUType", "start"], ["cpuType" => $cputype]);
        } else {
            $node = New VServerNode($this->dependencyInjector, $bestNode,"name");
            if($cputype == ""){
                $cputype = $node->getValue('defaultcputype');
            }
            $task = $this->createTask(["stop","changeCPUType", "migrateToBestNode", "start"],["targetNode" => $bestNode, "targetNodeId" => $node->getValue("id"), "cpuType" => $cputype]);
        }
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function fsTrim()
    {
        
        if($this->getImage()->getValue('type') != "windows"){
            return $this;
        }
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        if($proxmoxData["data"]["status"] != "running") {
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("vservernotrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        $this->node->fsTrimWindows($this->getChildValue('proxmoxid'));
    }

    public function shutdown()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }

        if($proxmoxData["data"]["status"] == "stopped") {
            
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("vserverallreadstopped"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        $task = $this->createTask(["shutdown"]);
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function install()
    {
        $this->regenerateMac();
        $this->regeneratePassword();
        $taskArray = [];
        $taskArray[] = "create";
        $taskArray[] = "config";
        $taskArray[] = "changeCPUType";
        $taskArray[] = "start";

        if($this->getImage()->getValue("type") == "windows"){
            $taskArray[] = "windowsSetNetwork";
        }
        $task = $this->createTask($taskArray,$this->getVmProxmoxData());
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function deleteVServer()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        if($proxmoxData["data"]["status"] == "stopped") {
            $task = $this->createTask(["delete"]);
        } else {
            $task = $this->createTask(["stop","delete"]);
        }
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function getProxmoxDescription()
    {
        $ips = $this->getIpAdresses();

        $ipv4Info = "";
        foreach ($ips["ipV4"] as $ip){
            $ipv4Info .= ", " . $ip->getValue("ip");
        }

        $ipv6Info = "";
        foreach ($ips["ipV6"] as $subnet){
            $ipv6Info .= ", " . $subnet->getValue("netmask") . "/64";
        }

        $description = "Userid: " . $this->getValue('userid') . "<br>";
        $description .= "ServiceID: " . $this->getValue('id') . "<br>";
        $description .= "ServerID: " . $this->getChildValue('id') . "<br>";
        $description .= "IPv4: " . $ipv4Info . "<br>";
        $description .= "IPv6: " . $ipv6Info . "<br>";
        return $description;
    }

    public function getImage()
    {
        return new \VServerImage($this->dependencyInjector, $this->getChildValue("imageid"),"intern_id");
    }

    public function getVmProxmoxData()
    {
        $this->loadNode();
        $data = [];
        $data["proxmoxDescription"] = $this->getProxmoxDescription();
        $data["image"] = $this->getImage()->getValue("proxmox_id");
        $data["ipData"] = json_encode($this->getIpAdresses(true));
        $data["firewallData"] = json_encode($this->getIpAdresses(true));
        $data["targetNode"] = $this->node->getValue('name');
        $data["cpuType"] = $this->node->getValue('defaultcputype');
        if($this->getChildValue('cputype') != 'cputype'){
            $data["cpuType"] = $this->getChildValue('cputype');
        }
        return $data;
    }

    public function regeneratePassword()
    {
        $this->setChildValue('firstpw', random_str(20, '0123456789abcdefghjkmnopqrstuvwxABCDEFGHJKMNOPQRSTUVWX'));
        $this->updateChild();
        return $this->getChildValue('firstpw');
    }

    public function regenerateMac()
    {
        $this->setChildValue('mac','4e:65:06:' . implode(':', str_split(substr(md5(mt_rand()), 0, 6), 2)) );
        $this->updateChild();
        return $this->getChildValue('mac');
    }

    public function reapplyConfig()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }

        if($proxmoxData["data"]["status"] != "stopped") {
            $task = $this->createTask(["stop", "configOnly","start"],$this->getVmProxmoxData());
        } else {
            $task = $this->createTask(["configOnly","start"],$this->getVmProxmoxData());
        }
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function reinstall()
    {
        $this->loadNode();
        $this->regeneratePassword();
        $this->regenerateMac();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }

        $taskArray = [];

        if($proxmoxData["data"]["status"] != "stopped") {
            $taskArray[] = "stop";
        }
        $taskArray[] = "delete";
        $taskArray[] = "create";
        $taskArray[] = "config";
        $taskArray[] = "changeCPUType";
        $taskArray[] = "start";

        if($this->getImage()->getValue("type") == "windows"){
            $taskArray[] = "windowsSetNetwork";
        }

        $task = $this->createTask($taskArray,$this->getVmProxmoxData());
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function reset()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }

        if($proxmoxData["data"]["status"] != "running") {
            
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("vservernotrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        $task = $this->createTask(["reset"]);
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function getBestNode()
    {
        $this->loadNode();
        return $this->node->getBestNode();
    }

    public function start()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        if($proxmoxData["data"]["status"] == "running") {
            
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("vserverallreadrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        if($this->getChildValue("nodelock") == 0) {
            $bestNode = $this->getBestNode();
        } else {
            $bestNode = $this->node->getValue("name");
        }
        $cputype = "";
        if($this->getChildValue('cputype') != 'cputype'){
            $cputype = $this->getChildValue('cputype');
        }

        if($bestNode == $this->node->getValue("name")){
            if($cputype == ""){
                $cputype = $this->node->getValue('defaultcputype');
            }
            $task = $this->createTask(["changeCPUType", "start"], ["cpuType" => $cputype]);
        } else {
            $node = New VServerNode($this->dependencyInjector, $bestNode,"name");
            if($cputype == ""){
                $cputype = $node->getValue('defaultcputype');
            }
            $task = $this->createTask(["changeCPUType", "migrateToBestNode", "start"],["targetNode" => $bestNode, "targetNodeId" => $node->getValue("id"), "cpuType" => $cputype]);
        }
        if(is_a($task, Vserver::class)){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $this->trimQueueTask($task);
    }

    public function checkTask()
    {
        $queueInfo = $this->getQueueInfo();
        if(isset($queueInfo)){
            
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("queuetaskrunning"));
            $this->dependencyInjector->setResponseCode(406);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return null;
    }

    public function createTask($tasklist, $data = [])
    {
        if(is_a($this->checkTask(), Vserver::class)){
            return $this;
        }
        $vserverQueue = new VServerQueueNew($this->dependencyInjector, null);
        $vserverQueue = $vserverQueue->newTask($this->getValue("serviceid"), $tasklist, $data);
        if(!is_a($vserverQueue, VServerQueueNew::class)){
            return $this;
        }
        return $vserverQueue;
    }

    public function getProxmoxData()
    {
        $this->loadNode();
        $proxmoxData = $this->node->getKVMCurrentStatus($this->getChildValue("proxmoxid"));
        if(!isset($proxmoxData["data"])){
            $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("proxmoxconnectionerror"));
            $this->dependencyInjector->setResponseCode(500);
            $this->dependencyInjector->setFail(true);
            return $this;
        }
        return $proxmoxData["data"];
    }

    public function loadNode()
    {
        if(!isset($this->node)){
            $this->node = new VServerNode($this->dependencyInjector,$this->getChildValue("nodeid"));
        }
    }
}