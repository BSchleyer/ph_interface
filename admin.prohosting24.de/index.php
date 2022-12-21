<?php


$router->addroute("logout", "main/logout.php");
$router->addroute("login", "main/login.php");
$router->addroute("index", "main/index.php");
$router->addroute("rechte", "main/rights.php");
$router->addroute("gruppen", "main/groups.php");
$router->addroute("kunden", "main/kundenliste.php");
$router->addroute("templates", "main/templates.php");
$router->addroute("kundendetails", "main/kundendetails.php");
$router->addroute("transactions", "main/transaktionen.php");
$router->addroute("changelog", "main/changelog.php");


$router->addroute("vserver", "vserver/main.php");
$router->addroute("nodes", "vserver/nodes.php");
$router->addroute("images", "vserver/images.php");
$router->addroute("packets", "vserver/packets.php");
$router->addroute("lostvms", "vserver/lostvms.php");


$router->addroute("domain", "domain/main.php");
$router->addroute("lostdomains", "domain/lostdomains.php");


$router->addroute("support", "support/main.php");
$router->addroute("support/tickets", "support/ticketlist.php");
$router->addroute("support/ticket/details", "support/ticketdetails.php");


ob_start();
$user = new User();
$url = $config->getconfigvalue('url');

if (isset($_COOKIE["ph24_sessionid"])) {
    $apirespond = requestBackend($config, ["sessionid" => $_COOKIE["ph24_sessionid"], "ip" => getclientip()], "userverify");
    if ($apirespond["fail"] == 1) {
        
        setcookie('ph24_sessionid', null, -1, '/');
		setcookie('ph24_sessionid', null, -1, '/cp/');
        header('Location: ' . $url);
        die();
    }
    $user->setSessionid($_COOKIE["ph24_sessionid"]);
    $user->setEmail($apirespond["response"]["email"]);
    $user->setUsername($apirespond["response"]["username"]);
    $user->setVorname($apirespond["response"]["vorname"]);
    $user->setNachname($apirespond["response"]["nachname"]);
    $user->setGuthaben($apirespond["response"]["guthaben"]);
    $user->setID($apirespond["response"]["id"]);
    $user->setGroups($apirespond["response"]["groups"]);
    $user->setRights($apirespond["response"]["rights"]);
    $user->setIshourly($apirespond["response"]["ishourly"]);
    $user->setCanhourly($apirespond["response"]["canhourly"]);
    $user->setServicecount($apirespond["response"]["servicecount"]);
    $user->setTicketcount($apirespond["response"]["ticketcount"]);
    $user->setDomaincount($apirespond["response"]["domaincount"]);
    $user->setApikey($apirespond["response"]["apikey"]);
    $user->setLoginemail($apirespond["response"]["loginemail"]);
    $user->setCreated_on($apirespond["response"]["created_on"]);
    $user->setStatus($apirespond["response"]["status"]);
    $user->setSupportPin($apirespond["response"]["supportpin"]);
    
    if (!$user->checkright(1)) {
        die();
    }
} else {
    header('Location: ' . $config->getconfigvalue("cp"));
    die();
}


if (!$router->checkroute($content[0])) {
    echo "Route does not exists.";
    die();
}

$router->sendclient($content[0], $router, $config, $content, $user);




