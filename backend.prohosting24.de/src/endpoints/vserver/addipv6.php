<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["id", "ip"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}


$ipv6Split = explode(":", $_POST["ip"]);
if(count($ipv6Split) != 8){
    $response->setfail(true, $dependencyInjector->getLang()->getString("novalidipv6"));
    return;
}

foreach ($ipv6Split as $split){
    if(strlen($split) == 0){
        $response->setfail(true, $dependencyInjector->getLang()->getString("novalidipv6"));
        return;
    }
    if(strlen($split) > 4){
        $response->setfail(true, $dependencyInjector->getLang()->getString("novalidipv6"));
        return;
    }
    if(!ctype_xdigit($split)){
        $response->setfail(true, $dependencyInjector->getLang()->getString("novalidipv6"));
        return;
    }
}
$ipv6 = strtolower(implode(":", array_slice(explode(":", $_POST["ip"]),0 ,4)));

$server = new VServer($dependencyInjector);
$server->loadwithid($_POST["id"]);

$ipv6Subnet = new IpSubnetv6($dependencyInjector,null);
$ipv6SubnetList = $ipv6Subnet->getAll(["serviceid" => $server->getServiceid()]);
foreach ($ipv6SubnetList as $subnet){
    if($subnet->getNetmaskOnly() == $ipv6){
        $ipv6 = new Ipv6($dependencyInjector,null);
        $ipCount = $ipv6->getAll(["ip" => strtolower($_POST["ip"]), "subnet" => $subnet->getValue("id")], true);
        if(count($ipCount) != 0){
            $response->fail(true, $dependencyInjector->getLang()->getString("ipv6allreadyinuse"));
        }
        $ipv6->setValue("ip", strtolower($_POST["ip"]));
        $ipv6->setValue("mac", " ");
        $ipv6->setValue("subnet", $subnet->getValue("id"));
        $ipv6->create();
        $response->setresponse("");
        return;
    }
}
$response->setfail(true, $dependencyInjector->getLang()->getString("novalidipv6"));