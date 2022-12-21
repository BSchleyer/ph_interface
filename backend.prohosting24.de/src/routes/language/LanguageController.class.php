<?php


class LanguageController extends RouteTarget
{

    public function getLanguageList()
    {
        $lang = new Language($this->dependencyInjector, null);
        $langList = $lang->getAll(["active" => 1], true);
        $this->dependencyInjector->getResponse()->setresponse($langList);
    }

    public function getFullLanguageList()
    {
        $languageMaster  = new Language($this->dependencyInjector, null);

        $langauges = $languageMaster->getAll([]);
        $langArray = [];
        $default = "";
        $langInfo = [];
        $langs = [];
        foreach ($langauges as $language){
            $langs[$language->getValue("lang")] = $language->getAllStrings();
            $langArray[] = $language->getValue("lang");
            if($language->getValue("default") == 1){
                $default = $language->getValue("lang");
            }
            $langInfo[$language->getValue("lang")] = ["domain" => $language->getValue("domain")];
        }
        $this->dependencyInjector->getResponse()->setresponse(["langInfo" => ["list" => $langArray,"data" => $langInfo, "default" => $default], "langs" => $langs]);
    }

}