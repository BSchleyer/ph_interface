<?php

defined('RZGvsletoIujWnzKrNyB') or die();

$apirespond = requestBackend($config, ["userid" => $user->getID()], "getAccessByUserId");

$response->setresponse($apirespond["response"]);