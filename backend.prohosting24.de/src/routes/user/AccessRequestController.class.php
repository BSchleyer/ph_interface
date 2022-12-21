<?php


class AccessRequestController extends RouteTarget
{

    public function createAccessRequest()
    {
        Functions::checkArray(["productId", "id", "displayname", "invitecode", "accessrights"], $_POST);
        if(count($_POST["accessrights"]) < 0){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("permissonempty"));
        }
        $user = new UserNew($this->dependencyInjector, null);
        $user = $user->getAll(["invitecode" => $_POST["invitecode"]]);
        if(count($user) != 1){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("invitecodenotexisting"));
        }
        $user = $user[0];

        $service = new Service($this->dependencyInjector, null);
        $service = $service->getAll(["produktid" => $_POST["productId"], "serviceid" => $_POST["id"]]);
        if(count($service) != 1){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("servicenotexisting"));
        }
        $service = $service[0];

        $accessRequestCheck = new AccessUser($this->dependencyInjector, null);
        $accessRequestCheck = $accessRequestCheck->getAll(["serviceid" => $service->getValue("id"),"userid" => $user->getValue("id"), "status[!]" => 3]);
        if(count($accessRequestCheck) != 0) {
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("accessalreadyexisting"));
        }

        $accessRequest = new AccessUser($this->dependencyInjector, null);
        $accessRequest->setValue("serviceid", $service->getValue("id"));
        $accessRequest->setValue("userid", $user->getValue("id"));
        $accessRequest->setValue("name", $_POST["displayname"]);
        $accessRequest->create();
        $rights = new AccessRights($this->dependencyInjector, null);
        $rights = $rights->getAll(["productid" => $_POST["productId"]]);

        $rightList = [];
        foreach ($rights as $right){
            $rightList[] = $right->getValue("id");
        }
        foreach ($_POST["accessrights"] as $accessright){
            if(in_array($accessright, $rightList)){
                $right  = new AccessUserRights($this->dependencyInjector, null);
                $right->setValue("accessuserid", $accessRequest->getValue("id"));
                $right->setValue("rightid", intval($accessright));
                $right->create();
            }
        }
    }

}