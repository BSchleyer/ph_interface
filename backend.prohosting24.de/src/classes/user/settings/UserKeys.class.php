<?php


class UserKeys extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("main_user_keys", $dependencyInjector, $value, $key);
    }

    public function delete($key = "id")
    {
        $userKeysVServer = new VServerKeys($this->dependencyInjector, null);

        $userKeysVServer = $userKeysVServer->getAll(["keyid" => $this->getValue("id")]);

        if(count($userKeysVServer) != 0){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("keydeleteerrorrefleft"));
        }

        parent::delete($key);
    }
}