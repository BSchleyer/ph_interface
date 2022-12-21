<?php


namespace PH24\service;

use BaseDatabase;
use http\Exception;
use OpenApi\Tests\Fixtures\ThirdPartyAnnotations;
use function GuzzleHttp\default_ca_bundle;

class Service extends BaseDatabase
{
    protected $childInfo = [];
    protected $childTable = "";

    public function __construct($dependencyInjector, $value, $type, $childTable, $productId)
    {
        $this->childTable = $childTable;
        switch ($type){
            case "serviceid":
                parent::__construct("service_main", $dependencyInjector, $value);
                $baseClass = new BaseDatabase($childTable, $this->dependencyInjector, $value);
                break;
            case "childid":
                parent::__construct("service_main", $dependencyInjector, null);
                $service = $this->getAll(["serviceid" => $value, "produktid" => $productId], true);
                if(count($service) != 1){
                    $this->dependencyInjector->setMessage($this->dependencyInjector->getLang()->getString("servicenotexisting"));
                    $this->dependencyInjector->setResponseCode(404);
                    $this->dependencyInjector->setFail(true);
                    return;
                }
                $this->fields = $service[0];
                $baseClass = new BaseDatabase($childTable, $this->dependencyInjector, $this->getValue("serviceid"));
                break;
            default:
                $dependencyInjector->setMessage($dependencyInjector->getLang()->getString("servicenotexisting"));
                $dependencyInjector->setResponseCode(404);
                $dependencyInjector->setFail(true);
                return;
                break;
        }
        $this->childInfo = $baseClass->getFields();
    }

    public function getIpAdresses($json = false)
    {
        $ipData = [];
        $ipv4 = new \Ipv4($this->dependencyInjector, null);
        $ipData["ipV4"] = $ipv4->getIpsByServive($this->getValue("id"),$json);
        $ipv4Subnet = new \IpSubnetv4($this->dependencyInjector, null);
        $subnetData = $ipv4Subnet->getAll([],true);
        $ipData["ipV4Subnet"] = [];
        foreach ($subnetData as $subnet){
            $ipData["ipV4Subnet"][$subnet["id"]] = $subnet;
        }
        $ipv6 = new \IpSubnetv6($this->dependencyInjector, null);
        $ipData["ipV6"] = $ipv6->getSubnetsByServive($this->getValue("id"),$json);
        return $ipData;
    }

    public function updateChild($key = "id")
    {
        $this->dependencyInjector->getDatabase()->update($this->childTable, $this->childInfo, [$key => $this->childInfo[$key]]);
    }

    public function setChildValue($key, $value)
    {
        $this->childInfo[$key] = $value;
    }

    public function getChildValue($key)
    {
        if (!isset($this->childInfo[$key])) {
            return $key;
        }
        return $this->childInfo[$key];
    }

    public function getServiceInfo()
    {
        return \Functions::convertTimeToUnix(\Functions::removeData($this->fields, ["hourly"]),["created_on","expire_at","delete_at"]);
    }
}