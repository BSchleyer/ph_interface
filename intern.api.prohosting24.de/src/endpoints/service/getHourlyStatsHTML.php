<?php

defined('RZGvsletoIujWnzKrNyB') or die();

$apirespond = requestBackend($config, ["userid" => $user->getId(), "date" => "2021-01-06"], "hourlyCalcServiceDisplay");

$response->setresponse($apirespond["response"]);