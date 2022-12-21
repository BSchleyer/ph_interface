<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
if (!checkpost($_POST, ["name"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
$domainarray = explode(".", $_POST["name"]);
if(count($domainarray) != 2){
    $response->fail(500,"Bitte eine Domain angeben.");
    return;
}
$domain = new Domain($masterdatabase, $config);

if (isset($_POST["all"])) {
    
    $toptld = ["de", "eu", "net", "com", "me", "at", "io"];
    if (isset($domainarray[1])) {
        if (!in_array($domainarray[1], $toptld)) {
            array_unshift($toptld, $domainarray[1]);
        }
    }
    $res = [];
    foreach ($toptld as $tld) {
        $special = false;
        $av = $domain->checkdomain(htmlspecialchars($domainarray[0]) . "." . $tld);
        if ($av) {
            $domainPrice = $domain->getdomainbytldprice($tld);
            $price = $domainPrice[0]["price_create"];
            if($domainPrice[0]["price_ownerchange"] != 0 || $domainPrice[0]["price_update"] != 0){
                $price = null;
                $av = false;
                $special = true;
            }
        } else {
            $domainPrice = $domain->getdomainbytldprice($tld);
            $price = $domainPrice[0]["price_transfer"];
        }
        $res[] = [
            "tld" => $tld,
            "sld" => htmlspecialchars($domainarray[0]),
            "price" => $price,
            "av" => $av,
            "special" => $special
        ];
    }
} else {
    $res = $domain->checkdomain($_POST["name"]);
}
$response->setresponse(["domain" => htmlspecialchars($_POST["name"]), "array" => $res]);
