<?php


$router->addroute("logout", "main/logout.php");
$router->addroute("index", "main/index.php");
$router->addroute("login", "main/login.php");
$router->addroute("registrieren", "main/login.php");
$router->addroute("register", "main/login.php");
$router->addroute("impressum", "main/imprint.php");
$router->addroute("imprint", "main/imprint.php");
$router->addroute("agb", "main/agb.php");
$router->addroute("tos", "main/agb.php");
$router->addroute("datenschutz", "main/privacy.php");
$router->addroute("privacypolicy", "main/privacy.php");
$router->addroute("privacy_policy", "main/datenschutz.php");
$router->addroute("404", "main/404.php");
$router->addroute("contact", "main/contact.php");
$router->addroute("kontakt", "main/contact.php");
$router->addroute("rechenzentrum", "main/datacenter.php");
$router->addroute("datacenter", "main/datacenter.php");
$router->addroute("rz", "main/datacenter.php");
$router->addroute("dc", "main/datacenter.php");
$router->addroute("server", "main/server.php");
$router->addroute("ddos-mitigation", "main/ddosprotection.php");
$router->addroute("ddos-schutz", "main/ddosprotection.php");
$router->addroute("virtualization", "main/virtualization.php");
$router->addroute("virtualisierung", "main/virtualization.php");
$router->addroute("hardware", "main/hardware.php");
$router->addroute("anbindung", "main/uplink.php");
$router->addroute("uplink", "main/uplink.php");
$router->addroute("link", "main/link.php");
$router->addroute("ceph", "main/ceph.php");
$router->addroute("a", "main/affiliate.php");


$router->addroute("sitemap", "extras/sitemap.php");
$router->addroute("sitemap.xml", "extras/sitemap.php");
$router->addroute("robots.txt", "extras/robots.txt");
$router->addroute(".well-known", "extras/wellknownManager.php");
$router->addroute("security.txt", "extras/security.php");


$router->addroute("vserver", "products/vserver.php");
$router->addroute("vps", "products/vserver.php");
$router->addroute("vserverpakete", "products/vserverpakete.php");
$router->addroute("vpsplans", "products/vserverpakete.php");
$router->addroute("domains", "products/domains.php");
$router->addroute("webspace", "products/webspace.php");
$router->addroute("dedicatedserver", "products/dedicatedserver.php");
$router->addroute("blackfriday", "products/blackfriday.php");



$router->addroute("apps", "main/apps.php");
$router->addroute("mariadb", "apps/mariadb.php");
$router->addroute("postgresql", "apps/postgresql.php");
$router->addroute("mongodb", "apps/mongodb.php");
$router->addroute("redis", "apps/redis.php");
$router->addroute("minecraft", "apps/minecraft.php");
$router->addroute("rust", "apps/rust.php");
$router->addroute("minecraft-nukkit", "apps/minecraft-nukkit.php");
$router->addroute("minecraft-pocketmine", "apps/minecraft-pocketmine.php");

$user = new User();


if (isset($_COOKIE["ph24_sessionid"])) {
    
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $config->getconfigvalue("backendendpoint"),
        CURLOPT_USERAGENT => 'ProHosting24 Intern',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => [
            'sessionid' => $_COOKIE["ph24_sessionid"],
            "ip" => getclientip(),
        ],
    ]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Function: userverify',
        'key: ' . $config->getconfigvalue("backendapikey"),
    ));
    
    $apirespond = json_decode(curl_exec($curl), true);
    
    curl_close($curl);
    if ($apirespond["fail"] == 1) {
        
        setcookie('ph24_sessionid', null, -1, '/');
    } else {
        $user->setSessionid($_COOKIE["ph24_sessionid"]);
        $user->setEmail($apirespond["response"]["email"]);
        $user->setUsername($apirespond["response"]["username"]);
        $user->setID($apirespond["response"]["id"]);
        $user->setGroups($apirespond["response"]["groups"]);
        $user->setRights($apirespond["response"]["rights"]);
        $user->setLang($apirespond["response"]["lang"]);
        $lang = new LanguageMaster($config,$apirespond["response"]["lang"]);
    }
}


if (!$router->checkroute($content[0])) {
    $router->sendclient("404", $router, $config, $content, $user, $lang);
    die();
}

$router->sendclient($content[0], $router, $config, $content, $user, $lang);
