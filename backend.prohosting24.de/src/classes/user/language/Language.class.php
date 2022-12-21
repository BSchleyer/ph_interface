<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class Language extends BaseDatabase
{
    private Predis\Client $client;

    private $langInfoCacheTag = "lang_langinfo";

    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("lang_main", $dependencyInjector, $value, $key);
        $this->client();
    }

    public function client()
    {
        $this->client = new Predis\Client($this->dependencyInjector->getConfig()->getconfigvalue("redis")["url"], ["parameters" => ["password" => $this->dependencyInjector->getConfig()->getconfigvalue("redis")["password"]]]);
    }

    public function setLangInfo($data)
    {
        $this->client->set(sha1($this->langInfoCacheTag), json_encode($data));
        $this->client->expire(sha1($this->langInfoCacheTag), 3600);
    }

    public function getLangTag($lang, $key)
    {
        $cacheTag = sha1($this->langInfoCacheTag . "_" . $lang . "_" . $key);
        $data = $this->client->get($cacheTag);
        if(!isset($data)){
            return $key;
        }
        return $data;
    }

    public function setLangTag($lang, $key, $value)
    {
        $cacheTag = sha1($this->langInfoCacheTag . "_" . $lang . "_" . $key);
        $this->client->set($cacheTag, $value);
        $this->client->expire($cacheTag, 3600);
    }

    public function getLangInfo()
    {
        return json_decode($this->client->get(sha1($this->langInfoCacheTag)), true);
    }

    public function getAllStrings()
    {
        $strings = new LanguageString($this->dependencyInjector, null);
        $strings = $strings->getAll([], true);

        $languageValues = new LanguageValue($this->dependencyInjector, null);
        $languageValues = $languageValues->getAll(["langid" => $this->getValue("id")], true);

        $langDone = [];

        foreach ($languageValues as $lang){
            $langDone[$lang["stringid"]] = $lang["string"];
        }

        $return = [];

        $langauges = $this->getAll(["default" => 1])[0];
        foreach ($strings as $string){
            if(isset($langDone[$string["id"]])){
                $lang = $langDone[$string["id"]];
                $return[$string["string"]] = $lang;
            } else {
                $return[$string["string"]] = $this->getStringById($string["id"], $langauges->getValue("default"));
            }
        }
        return $return;
    }

    public function getStringById($id, $langid)
    {
        $langValue = new LanguageValue($this->dependencyInjector, null);
        $langValue = $langValue->getAll(["stringid" => $id, "langid" => $langid]);
        if(count($langValue) != 1){
            return $id;
        }
        return $langValue[0]->getValue("string");
    }
}
