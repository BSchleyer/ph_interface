<?php

defined('RZGvsletoIujWnzKrNyB') or die();
if (!checkpost($_POST, ["id", "groupid", "product"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$ownerid = requestBackend($config, ["id" => $_POST["groupid"]], "getgroupowner");
if ($ownerid["response"] != $user->getID()) {
    $response->setfail(true, $lang->getString("groupnotowner"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

switch ($_POST["product"]) {
    case 1:
        $ownerid = requestBackend($config, ["id" => $_POST["id"]], "getvserverowner");
        if ($ownerid["response"] != $user->getID()) {
            $response->setfail(true, $lang->getString("vservernotowner"));
            print_r(json_encode($response->getresponsearray()));
            die();
        }
        break;
    case 2:
        $apirespond = requestBackend($config, ["id" => $_POST["id"]], "getwebspaceinfo");
        if ($apirespond["response"]["userid"] != $user->getID()) {
            $response->setfail(true, $lang->getString("webspacenotowner"));
            print_r(json_encode($response->getresponsearray()));
            die();
        }
        break;
    case 4:
        $ownerid = requestBackend($config, ["id" => $_POST["id"]], "getdomainowner");
        if ($ownerid["response"] != $user->getID()) {
            $response->setfail(true, $lang->getString("domainerrornotowner"));
            print_r(json_encode($response->getresponsearray()));
            die();
        }
        break;
    case 5:
        $ownerid = requestBackend($config, ["id" => $_POST["id"]], "pteroGetOwner");
        if ($ownerid["response"] != $user->getID()) {
            $response->setfail(true, $lang->getString("apperrornotowner"));
            print_r(json_encode($response->getresponsearray()));
            die();
        }
        break;

    default:
        $response->setfail(true, "Nicht Ihr Service");
        print_r(json_encode($response->getresponsearray()));
        die();
        break;
}


$apirespond = requestBackend($config, ["id" => $_POST["id"], "groupid" => $_POST["groupid"], "product" => $_POST["product"]], "saveservicegroup");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}
