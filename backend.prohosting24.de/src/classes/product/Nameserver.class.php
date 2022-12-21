<?php

use Exonet\Powerdns\Resources\ResourceRecord;


class Nameserver extends Base
{
    private $loopCounter = 0;
    private Exonet\Powerdns\Powerdns $apiClient;

    public function __construct(DependencyInjector $dependencyInjector)
    {
        $this->apiClient = new Exonet\Powerdns\Powerdns(
            $dependencyInjector->getConfig()->getconfigvalue("dnsApi")["url"],
            $dependencyInjector->getConfig()->getconfigvalue("dnsApi")["key"]
        );
        parent::__construct($dependencyInjector);
    }

    public function createDomain($domain, $ns)
    {
        $nsList = [];

        foreach ($ns as $entry){
            $nsList[] = $entry . ".";
        }

        try {
            return $this->apiClient->createZone($domain,$nsList, "Master");
        }catch (Exception $e){
            Functions::errorLog("domainCreate", "Domain create Error", $e);
            return false;
        }
    }

    public function getZone($domain)
    {
        return $this->apiClient->zone($domain);
    }

    public function addRecord($domain, $type, $content, $ttl, $name)
    {
        $type = $this->convertType($type);
        $zone = $this->getZone($domain);

        $zone->create([
            ['type' => $type, 'content' => $content, 'ttl' => $ttl, 'name' => $name]
        ]);
    }

    public function convertType($type)
    {
       return $type;
    }

    public function deleteRecord($domain, $name, $type)
    {
        $type = $this->convertType($type);
        $zone = $this->getZone($domain);

        $result = $zone->find($name, $type);

        foreach ($result as $entry){
            $entry->delete();
        }
    }

    public function getSpecifiedRecord($domain ,$name ,$type)
    {
        $zone = $this->getZone($domain);

        $result = $zone->find($name, $type);

        $return = [];

        foreach ($result as $entry){
            $return[] = [
                "name" => $entry->getName(),
                "content" => $entry->getRecords()[0]->getContent(),
                "type" => $entry->getType(),
                "ttl" => $entry->getTtl()
            ];
        }
        return $return;
    }

    public function getRecords($domain, $objects = false)
    {
        $zone = $this->getZone($domain);

        try {
            $result = $zone->get();
        } catch (\Exception $e) {
            return [];
        }

        if($objects){
            return $result;
        }

        $return = [];

        foreach ($result as $entry){
            $return[] = [
                "name" => $entry->getName(),
                "content" => $entry->getRecords()[0]->getContent(),
                "type" => $entry->getType(),
                "ttl" => $entry->getTtl()
            ];
        }
        return $return;
    }

    public function updateRecord($domain, $content, $ttl, $name, $oldName, $type)
    {
        $type = $this->convertType($type);
        $zone = $this->getZone($domain);

        $result = $zone->find($oldName, $type);

        foreach ($result as $entry){
            $entry->delete();
            $this->addRecord($domain,$type,$content,$ttl,$name);
        }
    }

    public function deleteDomain($domain)
    {
        $data = $this->getRecords($domain, true);
        foreach ($data as $entry){
            $entry->delete();
        }
    }

    public function getAllDomains()
    {
        return $this->apiClient->listZones();
    }


    public function adddomain($domain)
    {
        $this->createDomain($domain, $this->dependencyInjector->getConfig()->getconfigvalue('dnsApi')["ns"]);
    }

    public function checkDomain($domain, $resolver = null)
    {
        if($this->loopCounter > 6){
            $this->dependencyInjector->getResponse()->fail(true, $this->dependencyInjector->getLang()->getString("domainordererror") );
        }
        if(!isset($resolver)){
            $resolver = new Net_DNS2_Resolver(['nameservers' => ['116.203.126.131']]);
        }
        try {
            $resp = $resolver->query($domain, 'SOA');
            if(count($resp->answer) == 0){
                sleep(10);
                $this->loopCounter++;
                $this->checkDomain($domain, $resolver);
            }
        } catch (Exception $e){
            sleep(10);
            $this->checkDomain($domain, $resolver);
        }
    }

}
