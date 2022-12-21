<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class AccessUser extends BaseDatabase
{
    public function __construct($dependencyInjector, $value, $key = "id")
    {
        parent::__construct("access_user", $dependencyInjector, $value, $key);
    }

    public function getRightList()
    {
        $accessRights = new AccessUserRights($this->dependencyInjector, null);
        $accessRights = $accessRights->getAll(["accessuserid" => $this->getValue("id")]);

        $accessRightsReturn = [];

        foreach ($accessRights as $accessRight) {
            $accessRightsReturn[$accessRight->getValue("rightid")] = $accessRight->getValue("rightid");
        }
        return $accessRightsReturn;
    }
}
