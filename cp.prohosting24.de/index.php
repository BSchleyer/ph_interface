<?php


$router->addroute("index", "main/index.php");
$router->addroute("404", "main/404.php");
$router->addroute("settings", "main/settings.php");
$router->addroute("logout", "main/logout.php");
$router->addroute("login", "main/login.php");
$router->addroute("service", "main/servicelist.php");
$router->addroute("emaillog", "main/emaillog.php");
$router->addroute("invoice", "main/invoice.php");
$router->addroute("hourly", "main/hourlyCalc.php");
$router->addroute("access", "main/access.php");
$router->addroute("access/manage", "main/accessManage.php");

$router->addroute("newsletter", "newsletter/main.php");
$router->addroute("newsletter/u", "newsletter/unsubscribe.php");


$router->addroute("credit", "main/credit.php");
$router->addroute("credit/history", "main/credithistory.php");
$router->addroute("credit/add", "main/creditadd.php");
$router->addroute("credit/limit", "main/creditlimit.php");
$router->addroute("stripecheckout", "main/stripecheckout.php");
$router->addroute("coupon", "main/coupon.php");
$router->addroute("donation", "main/donation.php");



$router->addroute("invoice", "main/invoice.php");
$router->addroute("invoice/list", "main/invoiceList.php");
$router->addroute("invoice/details", "main/invoiceDetails.php");



$router->addroute("vserver", "vserver/main.php");
$router->addroute("vserver/details", "vserver/details.php");
$router->addroute("vserver/order", "vserver/order.php");
$router->addroute("vserver/order/p", "vserver/orderPacket.php");


$router->addroute("app", "ptero/main.php");
$router->addroute("app/details", "ptero/details.php");
$router->addroute("app/order", "ptero/order.php");


$router->addroute("support", "support/main.php");
$router->addroute("support/ticket", "support/ticket.php");


$router->addroute("webspace", "webspace/main.php");
$router->addroute("webspace/details", "webspace/details.php");
$router->addroute("webspace/order", "webspace/order.php");


$router->addroute("domain", "domain/main.php");
$router->addroute("domain/details", "domain/details.php");
$router->addroute("domain/order", "domain/order.php");



$router->addroute("affiliate", "affiliate/details.php");

$router->addroute("donate", "main/donateHandler.php");

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
	$user->setSecret($apirespond["response"]["secret"]);
	$user->setSupportPin($apirespond["response"]["supportpin"]);
	$user->setMonthlycost($apirespond["response"]["monthlycost"]);
	$user->setNewsletter($apirespond["response"]["newsletter"]);
	$user->setLang($apirespond["response"]["lang"]);
	$user->setInviteCode($apirespond["response"]["inviteCode"]);
	$user->setCreditLimit($apirespond["response"]["creditLimit"]);
	$user->setDarkMode($apirespond["response"]["darkmode"]);
	if($apirespond["response"]["darkmode"] == "1"){
		$_COOKIE["ph24_dark"] = 1;
	} else {
		$_COOKIE["ph24_dark"] = 0;
	}
} else {
	$langMaster = new LanguageMaster($config, ""); 
	$langList = $langMaster->getLangInfo();
	$defaultLang = $langList["default"];
    if(in_array($content[0], $langList["list"])){
        $lang = $content[0];
        array_shift($content);
        if(count($content) == 0 || $content[0] === ""){
            $content[0] = "index";
        }
    } else {
        $lang = $defaultLang;
    }
	if (strpos($_SERVER['HTTP_HOST'], 'prohosting24.net') !== false) {
		$lang = "en";
	}
	$lang = new LanguageMaster($config, $lang);

	if($content[0] == "donate"){
		$router->sendclient("donate", $router, $config, $content, $user,$lang);
		die();
	}

    
    $router->sendclient("login", $router, $config, $content, $user,$lang);
    die();
}
$lang = new LanguageMaster($config, $apirespond["response"]["lang"]);

if (!$router->checkroute($content[0])) {
    $router->sendclient("404", $router, $config, $content, $user,$lang);
    die();
}

$router->sendclient($content[0], $router, $config, $content, $user,$lang);
