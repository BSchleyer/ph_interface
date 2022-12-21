<?php


namespace Ph24\service;

use BaseDatabase;
use Functions;

class SpecialOffer extends BaseDatabase
{

    private VServerPacket $packet;

    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("vserver_special_offer", $dependencyInjector, $value, $key);
    }

    public function loadPacketData()
    {
        if(isset($this->packet)) return;
        $this->packet = new VServerPacket($this->dependencyInjector, $this->fields["packetid"]);
    }

    public function getPacketData()
    {
        $this->loadPacketData();
        return $this->packet->getData();
    }

    public function getData()
    {
        $return = Functions::removeData($this->fields,["limit","start_on","finish_on","created_on"]);
        $return["packetInfo"] = $this->getPacketData();
        return $return;
    }
}