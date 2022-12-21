<?php


class CacheManager
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function cachePage($string)
    {
        $data = ob_get_clean();
        file_put_contents('src/cache/' . sha1($string) . '.html', $data);
        echo $data;
    }

    public function getCachedPage($string)
    {
        if(file_exists('src/cache/' . sha1($string) . '.html')){
            $fileAge = filemtime('src/cache/' . sha1($string) . '.html');
            $nextPull = strtotime('+ ' . $this->config->getconfigvalue("cache")["cacheLifetime"], $fileAge);
            if($nextPull < time()){
                return;
            }
            echo file_get_contents('src/cache/' . sha1($string) . '.html');
            die();
        }
    }

}
