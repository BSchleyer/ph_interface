<?php


class AuthManager
{
    protected DependencyInjector $dependencyInjector;
    private \Predis\Client $client;

    public function __construct($dependencyInjector)
    {
        $this->dependencyInjector = $dependencyInjector;
        $this->loadClient();
    }

    public function loadClient()
    {
    }

    public function checkAuth()
    {
        if(!isset($_GET["token"])){
            return false;
        }
        $session = new Session($this->dependencyInjector, null);
        $user = $session->join("main_user", ">", "UserNew", ["userid" => "id"], ["session_token" => $_GET["token"],"ip" => Functions::getClientIp()]);
        if(!isset($user)){
            return false;
        }
        $this->dependencyInjector->setUser($user);
        return true;
    }

    public function checkAuthServiceId($productId, $serviceId, $response)
    {
        if(!$this->checkAuth()){
            return $this->dependencyInjector->getNewResponse()->getError($response, 401, $this->dependencyInjector->getLang()->getString("novalidauth"));
        }

        $service = new Service($this->dependencyInjector, null);
        $service = $service->getAll(["produktid" => $productId, "serviceid" => $serviceId]);
        if(count($service) != 1){
            return $this->dependencyInjector->getNewResponse()->getError($response, 404, $this->dependencyInjector->getLang()->getString("servicenotexisting"));
        }
        $service = $service[0];

        if($service->getValue("userid") != $this->dependencyInjector->getUser()->getValue("id")){
            return $this->dependencyInjector->getNewResponse()->getError($response, 403, $this->dependencyInjector->getLang()->getString("servicenotowner"));
        }

        if($service->getValue("delete_done") == 1){
            return $this->dependencyInjector->getNewResponse()->getError($response, 404, $this->dependencyInjector->getLang()->getString("serviceexpired"));
        }
        return true;
    }

}