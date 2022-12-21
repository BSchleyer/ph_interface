<?php


class HourlyPacket extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_packets", $dependencyInjector, $value, $key);
    }

    public function getValues()
    {
        $packetValues = new HourlyPacketValues($this->dependencyInjector, null);
        return $packetValues->getAll(["packetid" => $this->getValue("id")]);
    }
}
