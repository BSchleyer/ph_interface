<?php


class PteroProductController extends RouteTarget
{

    public function getProduct()
    {
        Functions::checkArray(["id"],$_POST);
        $product = new PteroProducts($this->dependencyInjector,$_POST["id"]);
        $result = [];
        $result["id"] = $product->getValue("id");
        $result["displayname"] = $product->getValue("displayname");
        $result["packets"] = $product->getPacketsData();
        $result["variables"] = $product->getVariablesData();
        $this->dependencyInjector->getResponse()->setresponse($result);
    }

    public function orderProduct()
    {
        Functions::checkArray(["productid", "packet", "userid","days"],$_POST);

        if (!is_numeric($_POST["days"])) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
            return;
        }
        if (strpos($_POST["days"], ',') !== false) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
            return;
        }
        if ($_POST["days"] < 30) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte eine Positive Zahl eingeben.");
            return;
        }
        if ($_POST["days"] > 365) {
            $this->dependencyInjector->getResponse()->setfail(true, "Maxmimal sind 365 Tage erlaubt.");
            return;
        }
        if (strpos($_POST["days"], '.') !== false) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
            return;
        }

        $requestVariables = [];

        foreach ($_POST as $key => $value){
            if (strpos($key, 'ptero_') !== false) {
                $requestVariables[str_replace("ptero_","",$key)] = $value;
            }
        }

        $product  =  new PteroProducts($this->dependencyInjector, $_POST["productid"]);

        $productVariables = $product->getVariablesData();

        $variables = [];
        $variableData = [];

        foreach ($productVariables as $variable){
            $variables[] = $variable["pteroid"];
            $variableData[$variable["pteroid"]] = $variable;
        }
        foreach ($requestVariables as $key => $variable){
            if(!in_array($key,$variables)){
                $this->dependencyInjector->getResponse()->fail(200,"Nicht erlaubte Variable.");
            }
            $data = $variableData[$key];
            $values = [];
            foreach ($data["variables"] as $value){
                $values[] = $value["value"];
            }
            if(!in_array($variable,$values)){
                $this->dependencyInjector->getResponse()->fail(200,"Nicht erlaubter Inhalt.");
            }
        }

        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(), $_POST["userid"]);

        $packet = $product->getPacketById($_POST["packet"]);
        if($packet == null){
            $this->dependencyInjector->getResponse()->fail(200,"Packet not found.");
        }
        $price = $packet["price"];
        $price30Days = $price;
        if (isset($_POST["discountcode"])) {
            if ($_POST["discountcode"] != "") {
                $discounto = new Discount($dependencyInjector, $_POST["discountcode"], "code");
                $discounto->checkDiscount(1);
                $discountedprice = $discounto->getPrice($price);
                $price = $discountedprice;
                $discount = $discounto->getData()["amount"];
                $discounto->redeem();
                if ($discounto->getValue('type') == 2) {
                    $discount = 0;
                }
            }
        } else {
            $discount = 0;
        }
        $price = ($price / 30) * $_POST["days"];
        $values = $packet["values"];

        if(!$user->pay("App Bestellung: " . $product->getValue("displayname"), $price, $this->dependencyInjector, false)){
            $this->dependencyInjector->getResponse()->setfail(true, $this->dependencyInjector->getLang()->getString("notenoughcredit"));
            return;
        }

        $pteroUser = new PteroUser($this->dependencyInjector);
        $pteroUser = $pteroUser->getUser($user);
        $ip = new Ipv4($this->dependencyInjector, null);
        $ip = $ip->getFreeIp();

        $ports = new PteroPorts($this->dependencyInjector, null);
        $ports = $ports->getPorts($_POST["productid"]);

        $node = new PteroNode($this->dependencyInjector, null);
        $node = $node->getFreeNode();
        $node->removeEmptyAllocations();
        $node->addIp($ip->getValue("ip"));
        $node->createAllocation($ip->getValue("ip"), $ports);
        $allocationInfo = $node->getAllocationPortsByIp($ip->getValue("ip"));

        $pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl($this->dependencyInjector->getConfig()->getconfigvalue("ptero_key"), $this->dependencyInjector->getConfig()->getconfigvalue("ptero_url"));

        $egg = $pterodactyl->egg($product->getValue("nest"), $product->getValue("egg"), ["variables"]);

        $dockerImage = $egg->dockerImage;

        if(isset($requestVariables["MINECRAFT_VERSION"])){
            switch ($requestVariables["MINECRAFT_VERSION"]){
                default:
                    $dockerImage = "ghcr.io/pterodactyl/yolks:java_8";
                    break;
                case "1.17.1":
                    $dockerImage = "ghcr.io/pterodactyl/yolks:java_16";
                    break;
                case "1.18":
                    $dockerImage = "ghcr.io/pterodactyl/yolks:java_17";
                    break;
            }
        }

        $data = [
            "name" => $product->getValue("displayname") . random_str(10),
            "user" => $pteroUser->id,
            "egg" => $product->getValue("egg"),
            "docker_image" => $dockerImage,
            "skip_scripts" => false,
            "environment" => [
                "SERVER_AUTOUPDATE" => '0'
            ],
            "limits" => [
                "memory" => 256,
                "swap" => 0,
                "disk" => 1024,
                "io" => 500,
                "cpu" => 100
            ],
            "feature_limits" => [
                "databases" => 0,
                "allocations" => count($allocationInfo),
                "backups" => 0
            ],
            "startup" => $egg->startup,
            "description" => "",
            "allocation" => [
                "default" => $allocationInfo[1],
                "additional" => $allocationInfo
            ],
            "deploy" => [
                "locations" => [$this->dependencyInjector->getConfig()->getconfigvalue("ptero_locationId")],
                "dedicated_ip" => true,
                "port_range" => []
            ],
            "start_on_completion" => true
        ];

        foreach ($values as $value){
            if(isset($data["limits"][$value["name"]])){
                $data["limits"][$value["name"]] = $value["value"];
            }
            if(isset($data["feature_limits"][$value["name"]])){
                $data["feature_limits"][$value["name"]] = $value["value"];
            }
        }

        foreach ($egg->relationships["variables"] as $env){
            if (strpos(strtolower($env["env_variable"]), 'pass') !== false) {
                $data["environment"][$env["env_variable"]] = random_str(20);
                continue;
            }
            if($env["default_value"] != "") {
                $data["environment"][$env["env_variable"]] = $env["default_value"];
            }
            if(isset($requestVariables[$env["env_variable"]])){
                $data["environment"][$env["env_variable"]] = $requestVariables[$env["env_variable"]];
            }
        }
        try {
            $response = $pterodactyl->createServer($data);
        } catch(Exception $e){
            $node->removeIp($ip->getValue("ip"));
            $node->removeEmptyAllocations();
            Functions::errorLog("pteroOrderError", "Error Ptero Order", $e);
            $this->dependencyInjector->getResponse()->setfail(true, "Es ist ein Fehler bei der Bestellung aufgetreten, bitte Kontaktieren Sie den Support.");
        }
        $productT = new PteroService($this->dependencyInjector,null);
        $productT->setValue("pteroid", $response->id);
        $productT->setValue("nodeid", $node->getValue("id"));
        $productT->setValue("productid", $_POST["productid"]);
        $productT->setValue("packetid", $_POST["packet"]);
        $productT->create();

        if(!$user->pay("App Bestellung: " . $product->getValue("displayname"), $price, $this->dependencyInjector)){
            $this->dependencyInjector->getResponse()->setfail(true, $this->dependencyInjector->getLang()->getString("notenoughcredit"));
            return;
        }
        $paymentId = $this->dependencyInjector->getDatabase()->id();
        if(!isset($discount)){
            $discount = 0;
        }
        $service = new Service($this->dependencyInjector, null);
        $service->setValue("userid", $_POST["userid"]);
        $service->setValue("discount", 0);
        $service->setValue("produktid", 5);
        $service->setValue("discount", $discount);
        $service->setValue("serviceid", $productT->getValue("id"));
        $service->setValue("price", $price30Days);
        $service->setValue("upgradeble", 1);
        $service->setValue("expire_at", date('Y-m-d H:i:s', strtotime('+' . $_POST["days"] . ' days')));
        $service->create();

        $creditLog = new CreditLog($this->dependencyInjector, $paymentId);
        $creditLog->setValue("serviceid",  $service->getValue("id"));
        $creditLog->update();

        $ip->setValue("serviceid", $service->getValue("id"));
        $ip->update();
        sendtodc('Neue App Bestellung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Kosten: ' . $price . ' €', $this->dependencyInjector->getConfig());
    }

    public function pteroGetOwner()
    {
        Functions::checkArray(["id"],$_POST);
        $data = $this->dependencyInjector->getDatabase()->select("service_main", [
            "[>]ptero_main" => ["serviceid" => "id"],
        ], [
            "service_main.userid",
        ], [
            "ptero_main.id" => $_POST["id"],
            "service_main.produktid" => 5,
        ]);
        $this->dependencyInjector->getResponse()->setresponse($data[0]["userid"]);
    }

    public function getpteroinfo()
    {
        
        Functions::checkArray(["id"],$_POST);
        $services = $this->dependencyInjector->getDatabase()->select("service_main", [
            "[>]ptero_main" => ["serviceid" => "id"],
            "[>]ptero_products" => ["ptero_main.productid" => "id"],
        ], [
            "service_main.expire_at",
            "service_main.delete_at",
            "service_main.serviceid",
            "service_main.id(serviceidnew)",
            "service_main.userid",
            "service_main.discount",
            "service_main.price",
            "service_main.name",
            "service_main.id(mainid)",
            "ptero_main.id",
            "service_main.status",
            "service_main.autorenew",
            "ptero_main.pteroid",
            "ptero_main.productid",
            "ptero_main.nodeid",
            "ptero_main.packetid",
            "ptero_products.displayname",
        ], [
            "ptero_main.id" => $_POST["id"],
            "service_main.produktid" => 5,
        ]);

        foreach ($services as $key => $ptero) {
            $access = new AccessUser($this->dependencyInjector, null);
            $access = $access->getAll(["serviceid" => $ptero["serviceidnew"], "status" => 1]);
            $accessList = [];

            foreach ($access as $accessEntry){
                $accessList[] = $accessEntry->getValue("userid");
            }
            $services[$key]["price"] = $ptero["price"] * (1 - $ptero["discount"]);
            $services[$key]["accessUsers"] = $accessList;
            $services[$key]["name"] = htmlspecialchars($services[$key]["name"]);
            $pteroService = new PteroService($this->dependencyInjector, $ptero["serviceid"]);
            try {
                $status = $pteroService->getStatus();
            } catch (Exception $e){
                $services[$key]["status"] = "installing";
                $status = "";
            }
            if ($ptero["status"] == 1) {
                $services[$key]["status"] = "locked";
            } else {
                if ((strtotime($ptero["expire_at"]) - time()) < 0) {
                    if ($ptero["delete_at"] != null) {
                        if ((strtotime($ptero["delete_at"]) - time()) < 0) {
                            $services[$key]["status"] = "deleted";
                        } else {
                            $services[$key]["status"] = "expired";
                        }
                    } else {
                        $services[$key]["status"] = "expired";
                    }
                } else {
                    if($status != ""){
                        $services[$key]["status"] = $status->currentState;
                    }
                }
            }
            if($status != ""){
                $services[$key]["diskUsage"] = round($status->resources["disk_bytes"] / 1000000000,2);
            } else {
                $services[$key]["diskUsage"] = 0;
            }
            $services[$key]["diskSpace"] = round($pteroService->getPteroData()->limits["disk"] / 1024, 2);
            $services[$key]["displayName"] = $ptero["displayname"];
            $services[$key]["delete_at"] = strtotime($ptero["delete_at"]);
            $services[$key]["timeleft"] = strtotime($ptero["expire_at"]);
            $product = new PteroProducts($this->dependencyInjector,$ptero["productid"]);
            $packet = $product->getPacketById($ptero["packetid"]);
            $services[$key]["packet"] = [];
            foreach ($packet["values"]as $data){
                $services[$key]["packet"][$data["name"]] = true;
            }
            try {
                $server = new PteroService($this->dependencyInjector,$_POST["id"]);
                $result = $server->getVariables();
                if(count($result["data"]) == 0){
                    $services[$key]["packet"]["variables"] = false;
                } else {
                    $services[$key]["packet"]["variables"] = true;
                }
            } catch (Exception $e){
                $services[$key]["packet"]["variables"] = false;
            }

            $user = new UserNew($this->dependencyInjector, $ptero["userid"]);

            $services[$key]["password"] = $user->getValue("pteropassword");
            $services[$key]["username"] = $user->getValue("username");
            if(!isset($ptero["name"])){
                $services[$key]["name"] = $ptero["displayname"] . " #" . $ptero["id"];
            } else {
                $services[$key]["name"] = htmlspecialchars($ptero["name"]);
            }
        }
        $this->dependencyInjector->getResponse()->setresponse($services[0]);
    }

    public function pteroRenew()
    {
        Functions::checkArray(["id","days"],$_POST);
        if (!is_numeric($_POST["days"])) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
            return;
        }
        if (strpos($_POST["days"], ',') !== false) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
            return;
        }
        if ($_POST["days"] < 1) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte geben Sie eine positive Zahl ein.");
            return;
        }
        if ($_POST["days"] > 365) {
            $this->dependencyInjector->getResponse()->setfail(true, "Es ist nur möglich das Webspace 1 Jahr zu verlängern.");
            return;
        }
        if (strpos($_POST["days"], '.') !== false) {
            $this->dependencyInjector->getResponse()->setfail(true, "Bitte geben Sie nur ganze Zahlen ohne Kommastellen an.");
            return;
        }
        $service = $this->dependencyInjector->getDatabase()->select("service_main", [
            "userid",
            "price",
            "discount",
            "expire_at",
            "delete_at",
            "id"
        ], [
            "serviceid" => $_POST["id"],
            "produktid" => 5,
        ]);

        $price = ($service[0]["price"] / 30) * $_POST["days"];
        $price = $price * (1 - $service[0]["discount"]);
        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(), $service[0]["userid"]);
        if(!$user->pay("App Verlängerung. App ID: " . $_POST["id"], $price, $this->dependencyInjector,true, $service[0]["id"])){
            $response->setfail(true, $this->dependencyInjector->getLang()->getString("notenoughcredit"));
            return;
        }
        if ($service[0]["delete_at"] != null) {
            $this->dependencyInjector->getDatabase()->update("service_main", [
                "expire_email" => 0,
                "expire_at" => date('Y-m-d H:i:s', strtotime(' + ' . $_POST["days"] . ' days')),
                "delete_at" => null,
            ], [
                "serviceid" => $_POST["id"],
                "produktid" => 5,
            ]);
        } else {
            $this->dependencyInjector->getDatabase()->update("service_main", [
                "expire_email" => 0,
                "expire_at" => date('Y-m-d H:i:s', strtotime($service[0]["expire_at"] . ' + ' . $_POST["days"] . ' days')),
                "delete_at" => null,
            ], [
                "serviceid" => $_POST["id"],
                "produktid" => 5,
            ]);
        }
        $server = new PteroService($this->dependencyInjector,$_POST["id"]);
        $server->unsuspend();
        $this->dependencyInjector->getResponse()->setresponse("");

        sendtodc('App Verlängerung.
User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
Länge: ' . $_POST["days"] . ' Tage
Kosten: ' . $price . ' €', $this->dependencyInjector->getConfig());

    }

    public function changeService()
    {
        Functions::checkArray(["id","calculate","packet"],$_POST);

        $serviceProduct = new PteroService($this->dependencyInjector,$_POST["id"]);
        $service = new Service($this->dependencyInjector, null);
        $service = $service->getServiceByServiceId($serviceProduct->getValue("id"),5)[0];
        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(),$service->getValue("userid"));

        $product = New PteroProducts($this->dependencyInjector,$serviceProduct->getValue("productid"));
        $oldPacket = New PteroPackets($this->dependencyInjector,$serviceProduct->getValue("packetid"));
        $newPacket = New PteroPackets($this->dependencyInjector,$_POST["packet"]);
        $discount = (1 - $service->getValue("discount"));
        $days = $service->getRemainingDays();
        $pricePerDayOld = $service->getPricePerDay();
        $pricePerDayNew = ($newPacket->getValue("price") * $discount) / 30;
        $oldPrice = round($pricePerDayOld * $days,2);
        $newPrice = round($pricePerDayNew * $days,2);

        $diff =  round($newPrice - $oldPrice,2) * -1;
        if($diff < 0){
            $change = false;
            $moneyAfter = round($user->getGuthaben() - ($diff * -1),2);
        } else {
            $change = true;
            $moneyAfter = round($user->getGuthaben() + $diff,2);
        }
        if($_POST["calculate"] == 1){
            $this->dependencyInjector->getResponse()->setresponse([
                "priceOne" => $diff,
                "priceMon" => ($newPacket->getValue("price") * $discount),
                "change" => $change,
                "moneyAfter" => $moneyAfter
            ]);
            return;
        }
        $serviceProduct->changePacket($newPacket);
        $user->changeguthaben($this->dependencyInjector->getDatabase(),$diff,"App Up/Downgrade");
        $service->setValue("price", $newPacket->getValue("price") * $discount);
        $service->update();
        $serviceProduct->stop();
        $serviceProduct->start();
        $this->dependencyInjector->getResponse()->setresponse("");
    }

    public function pteroGetPackets()
    {
        Functions::checkArray(["id"],$_POST);
        $serviceProduct = new PteroService($this->dependencyInjector,$_POST["id"]);
        $product = New PteroProducts($this->dependencyInjector,$serviceProduct->getValue("productid"));

        $packets = $product->getPacketsData();
        $return = [];
        foreach ($packets as $packet){
            $tmp = [];
            $tmp["id"] = $packet["id"];
            $tmp["data"] = "";
            foreach ($packet["values"] as $values){
                if($values["hide"] == 0){
                    $valueDisplay = $values["value"];
                    if($values["divide"] != "0"){
                        $valueDisplay = intval($valueDisplay) / intval ($values["divide"]);
                    }
                    $tmp["data"] .= $values["displayname"] . " " .  $valueDisplay .  $values["mark"] . " ";
                }
            }
            $return[] = $tmp;
        }

        $this->dependencyInjector->getResponse()->setresponse($return);
    }
}