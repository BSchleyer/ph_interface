<?php


class VServerKeysController extends RouteTarget
{
    public function get()
    {
        Functions::checkArray(["id"],$_POST);
        $keys = new VServerKeys($this->dependencyInjector, null);
        $keys = $keys->getAll(["vserverid" => $_POST["id"]]);
        $return = [];
        foreach ($keys as $key) {
            $key->loadKey();
            $split = explode(" ", htmlentities(htmlspecialchars($key->getKey()->getValue("key"))));
            if(isset($split[2])){
               $name = $split[2];
            } else {
                $name = $key->getValue("id");
            }
            $return[] = [
                "id" => $key->getValue("id"),
                "keyid" => $name,
                "key" => htmlentities(htmlspecialchars($key->getKey()->getValue("key"))),
                "created_on" => niceDate($key->getValue("created_on")),
            ];
        }
        $this->dependencyInjector->getResponse()->setresponse($return);
    }

    public function create()
    {
        Functions::checkArray(["serverid", "keyid"],$_POST);
        $key = new VServerKeys($this->dependencyInjector, null);
        $key->setValue("vserverid", $_POST["serverid"]);
        $key->setValue("keyid", $_POST["keyid"]);
        $key->create();
        $vserver = new VServer($this->dependencyInjector);
        $vserver->loadwithid($_POST["serverid"]);
        $vserver->configureKeys();
        $vserver = new \Ph24\service\VServer($this->dependencyInjector, $_POST["serverid"], "childid");
        $vserver->restart();
    }

    public function delete()
    {
        Functions::checkArray(["id"],$_POST);
        $key = new VServerKeys($this->dependencyInjector, $_POST["id"]);
        $vserver = new VServer($this->dependencyInjector);
        $vserver->loadwithid($key->getValue("vserverid"));
        $vserver->configureKeys();
        $vserver = new \Ph24\service\VServer($this->dependencyInjector, $key->getValue("vserverid"), "childid");
        $vserver->restart();
        $key->delete();
    }

}