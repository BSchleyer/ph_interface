<?php



$languageMaster  = new Language($dependencyInjector, null);

$langauges = $languageMaster->getAll([]);
$langArray = [];
$default = "";
$langInfo = [];
foreach ($langauges as $language){
    $strings = $language->getAllStrings();
    foreach ($strings as $key => $value) {
        $languageMaster->setLangTag($language->getValue("lang"), $key, $value);
    }
    $langArray[] = $language->getValue("lang");
    if($language->getValue("default") == 1){
        $default = $language->getValue("lang");
    }
    $langInfo[$language->getValue("lang")] = ["domain" => $language->getValue("domain")];
}

$languageMaster->setLangInfo(["list" => $langArray,"data" => $langInfo, "default" => $default]);