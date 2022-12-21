<?php


class AutoClassLoader
{
	private $classes = [];
	private $basePath = "src/classes";
	private $classConfig = "src/configs/classes.json";

	public function __construct($configPath = "src/classes", $classConfig = "src/configs/classes.json")
	{
	    $this->basePath = $configPath;
	    $this->classConfig = $classConfig;
		$this->load();
		$this->loadClasses();
	}

	public function load()
	{
		if ($this->checkConfig()) {
			$this->loadConfig();
		} else {
			$this->generateConfig();
		}
	}

	public function loadConfig()
	{
		$this->classes = json_decode(file_get_contents($this->classConfig), true);
	}

	public function generateConfig()
	{
        $this->readDir($this->basePath,['..', '.', 'AutoClassLoader.class.php']);
		$this->writeConfig();
	}

	public function readDir($dir, $exclude = ['..', '.'])
    {
        $content = array_diff(scandir($dir), $exclude);
        foreach ($content as $file){
            if(is_dir($dir . "/" .$file)){
                $this->readDir($dir . "/". $file);
            } else {
                $this->classes[] = $dir . "/" . $file;
            }
        }
    }

	public function writeConfig()
	{
		file_put_contents($this->classConfig, json_encode($this->classes));
	}

	public function checkConfig()
	{
		if (file_exists($this->classConfig)) {
			return true;
		}
		return false;
	}

	public function loadClasses()
	{
		foreach ($this->classes as $class) {
			require_once $class;
		}
	}
}