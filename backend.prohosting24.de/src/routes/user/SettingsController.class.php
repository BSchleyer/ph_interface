<?php


class SettingsController extends RouteTarget
{
    public function getSSHKeys()
    {
        Functions::checkArray(["userid"],$_POST);
        $keys = new UserKeys($this->dependencyInjector, null);
        $keys = $keys->getAll(["userid" => $_POST["userid"]], true);
        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(),$_POST["userid"]);
        foreach ($keys as $keyid => $key){
            $keys[$keyid]["key"] = htmlentities(htmlspecialchars($key["key"]));
            $split = explode(" ", htmlentities(htmlspecialchars($key["key"])));
            if(isset($split[2])){
                $keys[$keyid]["name"] = $split[2];
            } else {
                $keys[$keyid]["name"] = $user->getEmail() . " - " . $key["id"];
            }
            $keys[$keyid]["created_on"] = niceDate($key["created_on"]);
        }
        $this->dependencyInjector->getResponse()->setresponse($keys);
    }

    public function createSSHKey()
    {
        Functions::checkArray(["userid", "key"],$_POST);
        try {
            \phpseclib3\Crypt\RSA::load($_POST["key"]);
        }catch (Exception $e){
            $this->dependencyInjector->getResponse()->fail(500, $this->dependencyInjector->getLang()->getString("invalidsshkey"));
        }
        $key = new UserKeys($this->dependencyInjector, null);
        $key->setValue("key", $_POST["key"]);
        $key->setValue("userid", $_POST["userid"]);
        $key->create();
    }

    public function deleteSSHKey()
    {
        Functions::checkArray(["id"],$_POST);
        $key = new UserKeys($this->dependencyInjector, $_POST["id"]);
        $key->delete();
    }

    public function getSSHKeyOwner()
    {
        Functions::checkArray(["id"],$_POST);
        $key = new UserKeys($this->dependencyInjector, $_POST["id"]);
        $this->dependencyInjector->getResponse()->setresponse($key->getValue("userid"));
    }

}