<?php


class RatelimitManager
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

    public function check($name, $limit)
    {
        $data = $this->client->get($name . ":" . Functions::getClientIp());
        if (!isset($data)) {
            return false;
        }
        if ($data >= $limit) {
            return true;
        }
        return false;
    }

    public function add($name,$expire)
    {
        $limitKey = $name . ":" . Functions::getClientIp();
        $data = $this->client->get($limitKey);
        if (!isset($data)) {
            $this->client->set($limitKey, 1);
            $this->client->expire($limitKey, $expire);
        }
        $oldExpire = $this->client->ttl($limitKey);
        $this->client->set($limitKey, $data + 1);
        $this->client->expire($limitKey, $oldExpire);
    }
}