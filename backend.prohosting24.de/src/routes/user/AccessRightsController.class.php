<?php


class AccessRightsController extends RouteTarget
{

    public function getAll()
    {
        Functions::checkArray(["productId"],$_POST);

        $accessRights = new AccessRights($this->dependencyInjector, null);
        $accessRights = $accessRights->getAll(["productid" => $_POST["productId"]]);

        $return = [];

        foreach ($accessRights as $right){
            $return[] = [
                "name" => $this->dependencyInjector->getLang()->getString($right->getValue("displayname")),
                "id" => $right->getValue("id")
            ];
        }
        $this->dependencyInjector->getResponse()->setresponse($return);
    }

}