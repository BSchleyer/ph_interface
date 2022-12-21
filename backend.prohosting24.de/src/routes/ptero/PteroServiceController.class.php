<?php


class PteroServiceController extends RouteTarget
{
    public function pteroStart()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $server->start();
    }

    public function pteroStop()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $server->stop();
    }

    public function pteroShutdown()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $server->shutdown();
    }

    public function pteroCommand()
    {
        Functions::checkArray(["id","command"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $server->command($_POST["command"]);
    }

    public function deleteEmptyAllocations()
    {
        $node = new PteroNode($this->dependencyInjector, 1);
        $node->removeEmptyAllocations();
    }

    public function pteroWebsocket()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        try {
            $result = $server->websocket();
        }catch (Exception $e){
            $this->dependencyInjector->getResponse()->setresponse([]);
            return;
        }
        $this->dependencyInjector->getResponse()->setresponse($result["data"]);
    }

    public function pteroGetBackups()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $result = $server->getBackups();
        $this->dependencyInjector->getResponse()->setresponse($result["data"]);
    }

    public function pteroDeleteBackup()
    {
        Functions::checkArray(["id","name"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $server->deleteBackup($_POST["name"]);
    }

    public function pteroGetBackupLink()
    {
        Functions::checkArray(["id","name"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $result = $server->getBackupLink($_POST["name"]);
        $this->dependencyInjector->getResponse()->setresponse($result);
    }

    public function pteroCreateBackup()
    {
        Functions::checkArray(["id", "name"], $_POST);
        $server = new PteroService($this->dependencyInjector, $_POST["id"]);
        $server->createBackup($_POST["name"]);
    }

    public function pteroReinstall()
    {
        Functions::checkArray(["id"], $_POST);
        $server = new PteroService($this->dependencyInjector, $_POST["id"]);
        $server->reinstall();
    }

    public function pteroGetNetwork()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $result = $server->getAllocations();
        $this->dependencyInjector->getResponse()->setresponse($result);
    }

    public function pteroGetVariables()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $result = $server->getVariables();

        $return = [];
        $return["startup_command"] = $result["meta"]["startup_command"];
        $return["variables"] = [];
        foreach ($result["data"] as $data){
            $tmp = [];
            $tmp["is_editable"] = $data["is_editable"];
            $tmp["default_value"] = $data["default_value"];
            $tmp["description"] = $data["description"];
            $tmp["env_variable"] = $data["env_variable"];
            $tmp["name"] = $data["name"];
            $tmp["rules"] = $data["rules"];
            $tmp["server_value"] = $data["server_value"];
            $return["variables"][] = $tmp;
        }
        $this->dependencyInjector->getResponse()->setresponse($return);
    }

    public function pteroSetVariables()
    {
        Functions::checkArray(["id","val","variable"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        if($_POST["variable"] == "MINECRAFT_VERSION"){
            $server->getPteroDataApi();
            switch ($_POST["val"]){
                case "1.17.1":
                    $dockerImage = "ghcr.io/pterodactyl/yolks:java_16";
                    break;
                case "1.18":
                    $dockerImage = "ghcr.io/pterodactyl/yolks:java_17";
                    break;
                default:
                    $dockerImage = "ghcr.io/pterodactyl/yolks:java_8";
                    break;
            }
            $server->pterodactylClient->setImage($server->getIdentifier(),["docker_image" => $dockerImage]);
        }
        try {
            $result = $server->setVariables($_POST["val"],$_POST["variable"]);
        } catch(Exception $e) {
            if(isset($e->errors["errors"][0]["detail"])){
                $this->dependencyInjector->getResponse()->fail(true,$e->errors["errors"][0]["detail"]);
            } else {
                $this->dependencyInjector->getResponse()->fail(true,"Es ist ein Fehler aufgetreten.");
            }
        }
        $this->dependencyInjector->getResponse()->setresponse($result);
    }

    public function pteroGetSFTP()
    {
        Functions::checkArray(["id"],$_POST);
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $service = new Service($this->dependencyInjector,null);
        $service = $service->getServiceByServiceId($server->getValue("id"),5)[0];
        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(),$service->getValue("userid"));
        $pteroUser = new PteroUser($this->dependencyInjector);
        $pteroUser->changePasswort($user);
        $host = $server->getSFTPInfo();
        $host = $host["ip"] . ':' . $host["port"];
        $username = $server->getPteroDataApi();
        $username = strtolower($user->getUsername()) . "." . $username->identifier;
        $this->dependencyInjector->getResponse()->setresponse([
            "string" => "sftp://". $username . ":". $user->getPteropassword() . "@". $host,
            "username" => $username,
            "password" => $user->getPteropassword(),
            "host" => $host
        ]);
    }
}