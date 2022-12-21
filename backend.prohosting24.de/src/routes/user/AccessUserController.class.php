<?php


class AccessUserController extends RouteTarget
{

    public function getAccessList()
    {
        Functions::checkArray(["id", "productId"],$_POST);
        $service = new Service($this->dependencyInjector, null);
        $service = $service->getServiceByServiceId($_POST["id"], $_POST["productId"]);
        if(count($service) != 1){
            $this->dependencyInjector->getResponse()->fail(200, "Service not found");
        }
        $service = $service[0];

        $accessList = new AccessUser($this->dependencyInjector, null);
        $accessList = $accessList->getAll(["serviceid" => $service->getValue("id")]);

        $accessListReturn = [];

        foreach ($accessList as $accessUser) {
            $accessListReturn[] = [
                "status" => $accessUser->getValue("status"),
                "accepted_on" => niceDate($accessUser->getValue("accepted_on")),
                "created_on" => niceDate($accessUser->getValue("created_on")),
                "name" => htmlspecialchars($accessUser->getValue("name")),
                "id" => $accessUser->getValue("id"),
            ];
        }
        $this->dependencyInjector->getResponse()->setresponse($accessListReturn);
    }

    public function getAccessUserOwner()
    {
        Functions::checkArray(["id"],$_POST);
        $access = new AccessUser($this->dependencyInjector, $_POST["id"]);
        $service = new Service($this->dependencyInjector, $access->getValue("serviceid"));
        $this->dependencyInjector->getResponse()->setresponse($service->getValue("userid"));
    }

    public function getAccessUserTarget()
    {
        Functions::checkArray(["id"],$_POST);
        $access = new AccessUser($this->dependencyInjector, $_POST["id"]);
        $this->dependencyInjector->getResponse()->setresponse($access->getValue("userid"));
    }

    public function getAccessUserRights()
    {
        Functions::checkArray(["id"],$_POST);
        $access = new AccessUser($this->dependencyInjector, $_POST["id"]);

        $service = new Service($this->dependencyInjector, $access->getValue("serviceid"));

        $accessRights = new AccessUserRights($this->dependencyInjector, null);
        $accessRights = $accessRights->getAll(["accessuserid" => $access->getValue("id")]);
        $accessRightList = [];
        foreach ($accessRights as $right){
            $accessRightList[$right->getValue("rightid")] = $right;
        }

        $rights = new AccessRights($this->dependencyInjector, null);
        $rights = $rights->getAll(["productid" => $service->getValue("produktid")], true);

        $accessRightsReturn = [];
        foreach ($rights as $right){

            $checked = 0;
            if(isset($accessRightList[$right["id"]])){
                $checked = 1;
            }

            $accessRightsReturn[] = [
                "checked" => $checked,
                "id" => $right["id"],
                "name" =>  $this->dependencyInjector->getLang()->getString($right["displayname"])
            ];
        }
        $this->dependencyInjector->getResponse()->setresponse($accessRightsReturn);
    }

    public function saveAccessRequest()
    {
        Functions::checkArray(["productId", "id", "accessrights", "userid", "accessId"], $_POST);
        if(count($_POST["accessrights"]) < 0){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("permissonempty"));
        }

        $service = new Service($this->dependencyInjector, null);
        $service = $service->getAll(["produktid" => $_POST["productId"], "serviceid" => $_POST["id"]]);
        if(count($service) != 1){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("servicenotexisting"));
        }
        $service = $service[0];

        $accessRequestCheck = new AccessUser($this->dependencyInjector, $_POST["accessId"]);

        if($service->getValue("id") != $accessRequestCheck->getValue("serviceid")){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("servicenotexisting"));
        }

        $rights = new AccessRights($this->dependencyInjector, null);
        $rights = $rights->getAll(["productid" => $_POST["productId"]]);

        $rightList = [];
        foreach ($rights as $right){
            $rightList[] = $right->getValue("id");
        }

        $accesrightsInput = [];

        foreach ($_POST["accessrights"] as $accessright){
            $accesrightsInput[$accessright] = $accessright;
        }

        $currentRights = new AccessUserRights($this->dependencyInjector, null);
        $currentRights = $currentRights->getAll(["accessuserid" => $_POST["accessId"]]);

        foreach ($currentRights as $right){
            if(!isset($accesrightsInput[$right->getValue("rightid")])){
               $right->delete();
            } else {
                unset($accesrightsInput[$right->getValue("rightid")]);
            }
        }

        foreach ($accesrightsInput as $accessright){
            $right  = new AccessUserRights($this->dependencyInjector, null);
            $right->setValue("accessuserid", $_POST["accessId"]);
            $right->setValue("rightid", intval($accessright));
            $right->create();
        }
    }

    public function deleteAccessUser()
    {
        Functions::checkArray(["id"],$_POST);
        $access = new AccessUser($this->dependencyInjector, $_POST["id"]);
        $access->setValue("status", 3);
        $access->update();
    }

    public function acceptAccessUser()
    {
        Functions::checkArray(["id"],$_POST);
        $access = new AccessUser($this->dependencyInjector, $_POST["id"]);
        $access->setValue("status", 1);
        $access->update();
    }

    public function getAccessByUserId()
    {
        Functions::checkArray(["userid"],$_POST);
        $access = new AccessUser($this->dependencyInjector, null);
        $accessList = $access->getAll(["userid" => $_POST["userid"]]);

        $accessListReturn = [];

        foreach ($accessList as $accessUser) {
            $accessListReturn[] = [
                "status" => $accessUser->getValue("status"),
                "accepted_on" => niceDate($accessUser->getValue("accepted_on")),
                "created_on" => niceDate($accessUser->getValue("created_on")),
                "name" => htmlspecialchars($accessUser->getValue("name")),
                "serviceid" => $accessUser->getValue("serviceid"),
                "id" => $accessUser->getValue("id"),
            ];
        }
        $this->dependencyInjector->getResponse()->setresponse($accessListReturn);
    }

    public function getAccessUserInfo()
    {
        Functions::checkArray(["userid", "serviceid"],$_POST);
        $access = new AccessUser($this->dependencyInjector, null);
        $access = $access->getAll(["userid" => $_POST["userid"], "serviceid" => $_POST["serviceid"],"status" => 1]);
        if(count($access) != 1){
            $this->dependencyInjector->getResponse()->fail(2, "No Access");
        }
        $access = $access[0];

        $service = new Service($this->dependencyInjector, $access->getValue("serviceid"));
        $return = [];
        $return["productid"] = $service->getValue("produktid");
        $return["serviceid"] = $service->getValue("serviceid");
        $return["rights"] = $access->getRightList();
        $this->dependencyInjector->getResponse()->setresponse($return);
    }

    public function getAccessUserInfoByProduct()
    {
        Functions::checkArray(["userid", "id", "productid"],$_POST);

        $service = new Service($this->dependencyInjector, null);
        $service = $service->getAll(["produktid" => $_POST["productid"], "serviceid" => $_POST["id"]]);

        if(count($service) != 1){
            $this->dependencyInjector->getResponse()->fail(2, "No Service");
        }
        $service = $service[0];


        $access = new AccessUser($this->dependencyInjector, null);
        $access = $access->getAll(["userid" => $_POST["userid"], "serviceid" => $service->getValue("id"),"status" => 1]);
        if(count($access) != 1){
            $this->dependencyInjector->getResponse()->setresponse(["access" => false]);
        }
        $access = $access[0];

        $service = new Service($this->dependencyInjector, $access->getValue("serviceid"));
        $return = [];
        $return["access"] = true;
        $return["rights"] = $access->getRightList();
        $this->dependencyInjector->getResponse()->setresponse($return);
    }

    public function getAccessByOwnerUserId()
    {
        Functions::checkArray(["userid"],$_POST);

        $service = new Service($this->dependencyInjector, null);
        $service = $service->getAll(["userid" => $_POST["userid"], "delete_done" => 0]);

        $servicelist = [];

        foreach ($service as $entry){
            $servicelist[] = $entry->getValue("id");
        }


        $access = new AccessUser($this->dependencyInjector, null);
        $accessList = $access->getAll(["serviceid" => $servicelist]);

        $accessListReturn = [];

        foreach ($accessList as $accessUser) {
            $accessListReturn[] = [
                "status" => $accessUser->getValue("status"),
                "accepted_on" => niceDate($accessUser->getValue("accepted_on")),
                "created_on" => niceDate($accessUser->getValue("created_on")),
                "name" => htmlspecialchars($accessUser->getValue("name")),
                "serviceid" => $accessUser->getValue("serviceid"),
                "id" => $accessUser->getValue("id"),
            ];
        }
        $this->dependencyInjector->getResponse()->setresponse($accessListReturn);
    }

}