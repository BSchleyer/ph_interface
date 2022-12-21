<?php

class LanguageMaster
{
    private $lang = "";
    private $config;
    private $langData = [];
    private $langInfo = [];

    public function __construct($config,$lang)
    {
        $this->config = $config;
        $this->lang = $lang;
        $this->loadLangData();
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function loadLangData()
    {
        if(!file_exists('src/configs/languages/langinfo.json')){
            $this->getLangData();
            return;
        }
        $fileAge = filemtime('src/configs/languages/langinfo.json');
        $nextPull = strtotime('+ ' . $this->config->getconfigvalue("lang")["pullRate"], $fileAge);
        if($nextPull < time()){
            $this->getLangData();
            return;
        }
        $this->langInfo = json_decode(file_get_contents('src/configs/languages/langinfo.json'), true);
        if($this->lang == ""){
            $this->lang = $this->langInfo["default"];
        }
        $this->langData = json_decode(file_get_contents('src/configs/languages/' . $this->lang . '.json'), true);
    }

    public function getLangData()
    {
        $langData = json_decode(file_get_contents($this->config->getconfigvalue("lang")["langEndpoint"]), true);
        if(!isset($langData)){
            return;
        }
        file_put_contents('src/configs/languages/langinfo.json',json_encode($langData["langInfo"]));
        $this->langInfo = $langData["langInfo"];
        foreach ($langData["langs"] as $lang => $langData) {
            file_put_contents('src/configs/languages/' . $lang . '.json',json_encode($langData));
            if($lang == $this->lang){
                $this->langData = $langData;
            }
        }
    }

    public function getLangInfo()
    {
        return $this->langInfo;
    }

    public function getString($string)
    {
        if(!isset($this->langData[$string])){
            return $string;
        }
        return $this->langData[$string];
    }

    public function getStringWithData($string, $data)
    {
        if(!isset($this->langData[$string])){
            return $string;
        }
        foreach ($data as $key => $entry){
            $string = str_replace("{{" . $key . "}}", $entry , $this->langData[$string]);
        }
        return $string;
    }
}
