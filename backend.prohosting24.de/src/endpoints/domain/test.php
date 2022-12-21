<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


$domain = new Domain($dependencyInjector->getDatabase(), $dependencyInjector->getConfig());

print_r($domain->gatalldomainsfromapi());

print_r($domain->getAllHandelsFromApi());