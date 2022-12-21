<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class PteroNode extends BaseDatabase
{

    private \HCGCloud\Pterodactyl\Pterodactyl $pterodactyl;

    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("ptero_nodes", $dependencyInjector, $value, $key);
        $this->loadAPIClient();
    }

    public function loadAPIClient()
    {
        $this->pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl($this->dependencyInjector->getConfig()->getconfigvalue("ptero_key"), $this->dependencyInjector->getConfig()->getconfigvalue("ptero_url"));
    }

    public function addIp($ip)
    {
        $server = new VServer($this->dependencyInjector);
        $server->loadwithid($this->getValue("serverid"));
        $server->executecommand("ip addr add ". $ip . "/24 dev " . $this->getValue("interface"),false);
    }

    public function removeIp($ip)
    {
        $server = new VServer($this->dependencyInjector);
        $server->loadwithid($this->getValue("serverid"));
        $server->executecommand("ip addr del ". $ip . "/24 dev " . $this->getValue("interface"),false);
    }

    public function getFreeNode()
    {
        
        $nodes = $this->getAll(["active" => 1]);
        return $nodes[0];
    }

    public function getAllAllocations()
    {
        
        return $this->pterodactyl->allocations($this->getValue("pteroid"))["data"];
    }

    public function removeEmptyAllocations()
    {
        $allocations = $this->getAllAllocations();
        foreach ($allocations as $allocation){
            if(!$allocation->assigned){
                $this->pterodactyl->deleteAllocation($this->getValue("pteroid"),$allocation->id);
            }
        }

    }

    public function getAllocationPortsByIp($ip)
    {
        $allocations = $this->getAllAllocations();
        $allocationInfo = [];

        foreach ($allocations as $allocation){
            if($allocation->ip == $ip){
                $allocationInfo[] = $allocation->id;
            }
        }
        return $allocationInfo;
    }

    public function createAllocation($ip,$ports)
    {
        $this->pterodactyl->createAllocation($this->getValue("pteroid"), [
            "ip" => $ip,
            "ports" => $ports
        ]);
    }

    public function removeAllocationByIp($ip)
    {
        $allocations = $this->getAllocationPortsByIp($ip);
        foreach ($allocations as $allocation){
            $this->pterodactyl->deleteAllocation($this->getValue("pteroid"),$allocation);
        }
    }

}