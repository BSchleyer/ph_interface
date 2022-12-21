<?php


class CacheManager
{
    protected DependencyInjector $dependencyInjector;
    private \Predis\Client $client;

    public function __construct($dependencyInjector)
    {
        $this->dependencyInjector = $dependencyInjector;
        $this->loadClient();
    }

    public function loadClient()
    {
    }

    public function getCacheEntry($cacheId)
    {
        $data = $this->client->get($cacheId);
        if(!isset($data)){
            return null;
        }
        return json_decode($data,true);
    }

    public function setCacheEntry($cacheId, $data, $expire = 0)
    {
        $this->client->set($cacheId, json_encode($data));
        if($expire != 0){
            $this->client->expire($cacheId, $expire);
        }
    }

}