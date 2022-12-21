<?php

class LanguageMaster
{
    private $lang = "";
    private Predis\Client $client;
    private $langInfoCacheTag = "lang_langinfo";
    private $config;

    public function __construct($config,$lang)
    {
        $this->config = $config;
        $this->lang = $lang;
        $this->client();
    }
    public function client()
    {
        $this->client = new Predis\Client($this->config->getconfigvalue("redis")["url"], ["parameters" => ["password" => $this->config->getconfigvalue("redis")["password"]]]);
    }

    public function getString($string)
    {
        if(isset($_SERVER["HTTP_HOST"])){
            if(strpos($_SERVER["HTTP_HOST"], "localhost") !== false){
                return $string;
            }
        }
        $cacheTag = sha1($this->langInfoCacheTag . "_" . $this->lang . "_" . $string);
        $data = $this->client->get($cacheTag);
        if(!isset($data)){
            return $string;
        }
        return $data;
    }

    public function getStringWithData($string, $data)
    {
        if(isset($_SERVER["HTTP_HOST"])){
            if(strpos($_SERVER["HTTP_HOST"], "localhost") !== false){
                return $string;
            }
        }
        $cacheTag = sha1($this->langInfoCacheTag . "_" . $this->lang . "_" . $string);
        $string = $this->client->get($cacheTag);
        if(!isset($string)){
            return $string;
        }
        foreach ($data as $key => $entry){
            $string = str_replace("{{" . $key . "}}", $entry , $string);
        }
        return $string;
    }
}
