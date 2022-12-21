<?php


        $isoList = $vserver->getIsoList();

        foreach ($isoList as $entry){
            $result["iso"][] = [
                "id" => $entry["volid"],
                "name" => explode("/",$entry["volid"])[1]
            ];
        }

        $this->dependencyInjector->getResponse()->setresponse($result);
    }

    public function deleteDiskvServer()
    {
        Functions::checkArray(["id", "disk"],$_POST);
        $vserver = new VServer($this->dependencyInjector);
        $vserver->loadwithid($_POST["id"]);
        if(!preg_match('/ide[0-9]+/', $_POST["disk"])) {
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("proxmoxconfigentrynotexist"));
        }
        if(!$vserver->removeDisk($_POST["disk"])){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("proxmoxconfigentrynotexist"));
        }
        $vserver = new \Ph24\service\VServer($this->dependencyInjector, $_POST["id"], "childid");
        $vserver->restart();
    }

    public function mountDiskvServer()
    {
        Functions::checkArray(["id", "disk"],$_POST);
        $vserver = new VServer($this->dependencyInjector);
        $vserver->loadwithid($_POST["id"]);

        $isoList = $vserver->getIsoList();
        $disk = "";
        foreach ($isoList as $entry){
            if (strpos($entry["volid"], $_POST["disk"]) !== false) {
                $disk = $entry["volid"];
            }
        }
        if($disk == ""){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("proxmoxconfigentrynotexist"));
        }

        $vserver->addDisk($disk);
        $vserver = new \Ph24\service\VServer($this->dependencyInjector, $_POST["id"], "childid");
        $vserver->restart();
    }

    public function saveBootOrdervServer()
    {
        Functions::checkArray(["id", "boot"],$_POST);
        if(count($_POST["boot"]) != 3){
            $this->dependencyInjector->getResponse()->fail(1, MainConstants::FailVariable);
        }
        $vserver = new VServer($this->dependencyInjector);
        $vserver->loadwithid($_POST["id"]);

        $data = $vserver->getProxmoxConfig();
        $smallEntry = [];
        foreach ($data["data"] as $key => $entry){
            $smallEntry[] = $key;
        }

        foreach ($_POST["boot"] as $entry){
            if(!in_array($entry, $smallEntry)){
                $this->dependencyInjector->getResponse()->fail(1, MainConstants::FailVariable);
            }
        }
        $vserver->setBootOrder($_POST["boot"]);
    }

}