<?php


class DomainNew extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("domain_main", $dependencyInjector, $value, $key);
    }

    public function getDomainName()
    {
        $domain = new DomainList($this->dependencyInjector, $this->getValue("tld"));

        return $this->getValue("sld") . "." . $domain->getValue("tld");
    }
}