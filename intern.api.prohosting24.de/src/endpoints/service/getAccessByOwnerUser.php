<?php

defined('RZGvsletoIujWnzKrNyB') or die();

$apirespond = requestBackend($config, ["userid" => $user->getID()], "getAccessByOwnerUserId");

$response->setresponse($apirespond["response"]);