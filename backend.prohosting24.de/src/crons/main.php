<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


$router = new Router("src/crons/");

$router->addroute("serviceend", "serviceend.php");
$router->addroute("ratelimit", "ratelimit.php");
$router->addroute("updatedomainlist", "updatedomainlist.php");
$router->addroute("checkproxmoxtasks", "checkproxmoxtasks.php");
$router->addroute("backupDelete", "backupDelete.php");
$router->addroute("backupDeleteOld", "backupDeleteOld.php");
$router->addroute("misc", "misc.php");
$router->addroute("sessionexpire", "sessionexpire.php");
$router->addroute("checkclusterlog", "checkclusterlog.php");
$router->addroute("checkservers", "checkservers.php");
$router->addroute("fixnodeids", "fixnodeids.php");
$router->addroute("hourlypay", "hourlypay.php");
$router->addroute("hourlySaveTraffic", "hourlySaveTraffic.php");
$router->addroute("hourlySaveTrafficUsage", "hourlySaveTrafficUsage.php");
$router->addroute("langCacheCreator", "langCacheCreator.php");
$router->addroute("updateDomainExpire", "updateDomainExpire.php");
$router->addroute("createMonthlyInvoice", "createMonthlyInvoice.php");
$router->addroute("vservercrons", "vservercrons.php");
$router->addroute("vserverTraffic", "vserverTraffic.php");
$router->addroute("vserverTrafficProcessor", "vserverTrafficProcessor.php");
$router->addroute("deleteOldDomainHandels", "deleteOldDomainHandels.php");

try {
    $router->sendclient($cronaction, $response, $config, $masterdatabase, $dependencyInjector);
} catch (Exception $Exception) {
    Functions::errorLog("systemError", "Error In Code", $Exception);
    $response->setfail(true, "Error in Code");
    print_r(json_encode($response->getresponsearray()));
    die();
}

print_r(json_encode($response->getresponsearray()));
die();
