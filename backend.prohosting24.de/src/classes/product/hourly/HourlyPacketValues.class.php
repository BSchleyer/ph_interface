<?php


class HourlyPacketValues extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("hourly_packets_values", $dependencyInjector, $value, $key);
    }

    public function getValues()
    {
        $value = new HourlyValues($this->dependencyInjector, null);
        return $value->getAll(["id" => $this->getValue("valueid")])[0];
    }
}
