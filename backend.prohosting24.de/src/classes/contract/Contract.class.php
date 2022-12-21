<?php


namespace PH24\contract;


use BaseDatabase;

class Contract extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("contract_main", $dependencyInjector, $value, $key);
    }

    public function createFromType( ContractType $type)
    {
        $this->setValue("id", \Functions::gen_uuid());
        $this->setValue("contractperiod", $type->getValue("contractperiod"));
        $this->setValue("firstdiscount", $type->getValue("firstdiscount"));
        $this->setValue("recurringdiscount", $type->getValue("recurringdiscount"));
        $this->setValue("contractcancellationdays", $type->getValue("contractcancellationdays"));
        $this->setValue("paymentperiod", $type->getValue("paymentperiod"));
        $this->setValue("status", "CREATED");
        $this->setValue("serviceid", null);
        $this->setValue("nextduedate", \Functions::getCurrentDatePGSQL());
        $this->create();
    }
}