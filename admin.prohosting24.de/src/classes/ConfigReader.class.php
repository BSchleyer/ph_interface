<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();

class ConfigReader
{
    private $filepath;
    private $filearray = [];
    private $configfail = true;

    public function __construct($configfile)
    {
        
        if (!file_exists($configfile)) {
            
            return;
        }
        $this->filepath = $configfile;
        
        $this->filearray = json_decode(file_get_contents($configfile), true);
        $this->configfail = false;
    }

    function isset($configstring) {
        return isset($this->filearray[$configstring]);
    }

    public function getconfigstatus()
    {
        return $this->configfail;
    }

    public function getconfigvalue($configstring)
    {
        if ($this->isset($configstring)) {
            return $this->filearray[$configstring];
        } else {
            return false;
        }
    }

}
