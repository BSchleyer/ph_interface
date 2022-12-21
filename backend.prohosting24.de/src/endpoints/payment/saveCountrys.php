<?php


$sevDeskClient = new SevDeskApiClient($dependencyInjector);

$countrys = $sevDeskClient->getCountrys();
$sevDeskCountry = new SevdeskCountrys($dependencyInjector, null);
$sevDeskCountry->massDelete([]);

foreach ($countrys as $country){
    if($country["id"] == 1337){
        continue;
    }
    $sevDeskCountry = new SevdeskCountrys($dependencyInjector, null);
    $sevDeskCountry->setValue("id", $country["id"]);
    $sevDeskCountry->setValue("code", $country["code"]);
    $sevDeskCountry->setValue("namede", $country["name"]);
    $sevDeskCountry->setValue("nameen", $country["nameEn"]);
    $sevDeskCountry->setValue("translationcode", $country["translationCode"]);
    $sevDeskCountry->setValue("locale", $country["locale"]);
    $sevDeskCountry->create("id", false);
}