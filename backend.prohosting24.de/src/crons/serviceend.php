<?php


$currenttime = date('Y-m-d H:i:s', time());
$serviceinfos = $masterdatabase->select("service_main", [
    "id",
    "produktid",
    "serviceid",
], [
    "expire_at[<]" => $currenttime,
    "delete_at" => null,
    "hourly" => 0
]);
foreach ($serviceinfos as $service) {
    switch ($service["produktid"]) {
        case 1:
            try {
                $masterdatabase->update("service_main", [
                    "delete_at" => date('Y-m-d H:i:s', strtotime('+7 days', time())),
                ], [
                    "id[=]" => $service["id"],
                ]);
                $vserver = new \Ph24\service\VServer($dependencyInjector,$service["serviceid"],"childid");
                $vserver->stop();
                $userid = $masterdatabase->select("service_main", [
                    "userid",
                ], [
                    "id[=]" => $service["id"],
                ])[0]["userid"];
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $mail = new Mail($masterdatabase, $config);
                $mail->addmail("vserver_expire", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname()]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron", $Exception);
            }
            break;

        case 2:
            try {
                $masterdatabase->update("service_main", [
                    "delete_at" => date('Y-m-d H:i:s', strtotime('+7 days', time())),
                ], [
                    "id[=]" => $service["id"],
                ]);
                
                $webspace = new Webspace($masterdatabase, $config);
                $userid = $masterdatabase->select("service_main", [
                    "userid",
                ], [
                    "id[=]" => $service["id"],
                ])[0]["userid"];
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $mail = new Mail($masterdatabase, $config);
                $mail->addmail("webspace_expire", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname()]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron", $Exception);
            }
            break;

        case 4:
            $masterdatabase->update("service_main", [
                "delete_at" => date('Y-m-d H:i:s', strtotime('+3 days', time())),
            ], [
                "id[=]" => $service["id"],
            ]);
            
            try {
                $userid = $masterdatabase->select("service_main", [
                    "userid",
                ], [
                    "id[=]" => $service["id"],
                ])[0]["userid"];
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $domaininfo = $masterdatabase->select("service_main", [
                    "[>]domain_main" => ["serviceid" => "id"],
                    "[>]domain_list" => ["domain_main.tld" => "id"],
                ], [
                    "service_main.expire_at",
                    "service_main.delete_at",
                    "service_main.serviceid",
                    "service_main.discount",
                    "domain_main.id",
                    "domain_list.tld",
                    "domain_main.sld",
                    "domain_main.kontakt",
                    "domain_main.ns1",
                    "domain_main.ns2",
                    "domain_main.ns3",
                    "domain_main.ns4",
                    "domain_main.ns5",
                ], [
                    "service_main.id" => $service["id"],
                    "service_main.produktid" => 4,
                ]);
                $domain = new Domain($masterdatabase, $config);
                
                $domain->deletedomain($domaininfo[0]["sld"] . "." . $domaininfo[0]["tld"], date('Y-m-d H:i:s', strtotime('+2 days', time())));
                $masterdatabase->update("service_main", [
                    "delete_at" => date('Y-m-d H:i:s', strtotime('+2 days', time())),
                ], [
                    "id[=]" => $service["id"],
                ]);
                $mail = new Mail($masterdatabase, $config);
                $mail->addmail("domain_expire", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "domain_name" => $domaininfo[0]["sld"] . "." . $domaininfo[0]["tld"]]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron", $Exception);
            }
            break;

        case 5:
            try {
                $service = new Service($dependencyInjector, $service["id"]);
                $service->setValue("delete_at", date('Y-m-d H:i:s', strtotime('+7 days', time())));
                $service->update();
                $server = new PteroService($dependencyInjector,$service->getValue("serviceid"));
                $server->stop();
                $server->suspend();
                $userid = $service->getValue("userid");
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $mail = new Mail($masterdatabase, $config);
                $mail->addmail("app_expire", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname()]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron", $Exception);
            }
            break;
    }
    Functions::errorLog("systemServiceExpire","Service expire", [
        "serviceid" => $service["id"],
        "userid" => $user->getID(),
        "username" => $user->getUsername(),
        "name" => $user->getVorname() . " " . $user->getNachname(),
        "deleteAt" => date('Y-m-d H:i:s', strtotime('+7 days', time()))
    ], false);
    Functions::sendDataToDiscordFeed("Ein Dienst wurde erfolgreich gesperrt", "Der Service " . $service["id"] . " wurde für " . $user->getVorname() . " " . $user->getNachname() . " erfolgreich gesperrt.", "https://prohosting24.de/admin/kunden/" . $user->getID(), [[
        "name" => "ServiceId",
        "value" => $service["id"]
    ],[
        "name" => "DeleteAt",
        "value" => date('Y-m-d H:i:s', strtotime('+7 days', time()))
    ]]);
}
$serviceinfos = $masterdatabase->select("service_main", [
    "id",
    "produktid",
    "serviceid",
], [
    "delete_at[<]" => $currenttime,
    "delete_done" => 0,
    "hourly" => 0
]);

foreach ($serviceinfos as $service) {
    $status = 200;
    switch ($service["produktid"]) {
        case 1:
            try {
                $queueinfo = $masterdatabase->select("vserver_queue", [
                    "id",
                ], [
                    "serverid" => $service["serviceid"],
                    "action" => 5,
                ]);
                $vserver = New \Ph24\service\VServer($dependencyInjector, $service["serviceid"], "childid");
                $vserver->deleteVServer();
                $queue = new VServerQueue($dependencyInjector, null);
                $queue->setValue("serviceid", $service["serviceid"]);
                $queue->setValue("action", 10);
                $queue->setValue("data", "all");
                $queue->create();
                $ip = new Ipv4($dependencyInjector,null);
                $ip = $ip->freeIpsByServive($service["id"]);
                $ipv6 = new IpSubnetv6($dependencyInjector, null);
                $ipv6->freeSubnet($service["id"]);
                $userid = $masterdatabase->select("service_main", [
                    "userid",
                ], [
                    "id[=]" => $service["id"],
                ])[0]["userid"];
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $mail = new Mail($masterdatabase, $config);
                $mail->addmail("vserver_delete", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname()]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron. ServiceID: " . $service["id"], $Exception);
                $status = 500;
            }
            break;
        case 2:
            try {
                
                $webspace = new Webspace($masterdatabase, $config);
                $webspace->deletewebspace($service["serviceid"]);
                $userid = $masterdatabase->select("service_main", [
                    "userid",
                ], [
                    "id[=]" => $service["id"],
                ])[0]["userid"];
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $mail = new Mail($masterdatabase, $config);
                $mail->addmail("webspace_delete", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname()]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron", $Exception);
                $status = 500;
            }
            break;
        case 4:
            
            try {
                $userid = $masterdatabase->select("service_main", [
                    "userid",
                ], [
                    "id[=]" => $service["id"],
                ])[0]["userid"];
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $mail = new Mail($masterdatabase, $config);
                $domaininfo = $masterdatabase->select("service_main", [
                    "[>]domain_main" => ["serviceid" => "id"],
                    "[>]domain_list" => ["domain_main.tld" => "id"],
                ], [
                    "service_main.expire_at",
                    "service_main.delete_at",
                    "service_main.serviceid",
                    "service_main.discount",
                    "domain_main.id",
                    "domain_list.tld",
                    "domain_main.sld",
                    "domain_main.kontakt",
                    "domain_main.ns1",
                    "domain_main.ns2",
                    "domain_main.ns3",
                    "domain_main.ns4",
                    "domain_main.ns5",
                ], [
                    "service_main.id" => $service["id"],
                    "service_main.produktid" => 4,
                ]);
                $mail->addmail("domain_delete", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "domain_name" => $domaininfo[0]["sld"] . "." . $domaininfo[0]["tld"]]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron", $Exception);
                $status = 500;
            }
            break;

        case 5:
            
            try {
                $ptero = new PteroService($dependencyInjector,$service["serviceid"]);
                $ptero->deleteServer($service["id"]);
                $userid = $masterdatabase->select("service_main", [
                    "userid",
                ], [
                    "id[=]" => $service["id"],
                ])[0]["userid"];
                $user = new User();
                $user->load_id($masterdatabase, $userid);
                $mail = new Mail($masterdatabase, $config);
                $mail->addmail("app_delete", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname()]);
            } catch (Exception $Exception) {
                Functions::errorLog("systemCronError", "Error in Service End Cron", $Exception);
                $status = 500;
            }
            break;
    }
    if ($status == 200) {
        $masterdatabase->update("service_main", [
            "delete_done" => 1,
        ], [
            "id[=]" => $service["id"],
        ]);
        Functions::errorLog("systemServiceDeleteFinish","Service delete", [
            "serviceid" => $service["id"],
            "userid" => $user->getID(),
            "username" => $user->getUsername(),
            "name" => $user->getVorname() . " " . $user->getNachname()
        ], false);
        Functions::sendDataToDiscordFeed("Ein Dienst wurde erfolgreich gelöscht", "Der Service " . $service["id"] . " wurde für " . $user->getVorname() . " " . $user->getNachname() . " gelöscht.", "https://prohosting24.de/admin/kunden/" . $user->getID(), [[
            "name" => "ServiceId",
            "value" => $service["id"]
        ]]);
    }
}


$serviceinfos = $masterdatabase->select("service_main", "*" , [
    "expire_at[<]" => date('Y-m-d H:i:s', strtotime('+3 days')),
    "expire_email" => 0,
    "hourly" => 0
]);

foreach ($serviceinfos as $service) {
    if ($service["produktid"] == 4) {
        $masterdatabase->update("service_main", [
            "expire_email" => 1,
        ], [
            "id[=]" => $service["id"],
        ]);
        continue;
    }
    $productname = "";
    $userid = $masterdatabase->select("service_main", [
        "userid",
    ], [
        "id[=]" => $service["id"],
    ])[0]["userid"];
    $user = new User();
    $user->load_id($masterdatabase, $userid);
    $mail = new Mail($masterdatabase, $config);
    $autoRenew = false;
    switch ($service["produktid"]) {
        case 1:
            $productname = "HA KVM Server";
            break;
        case 2:
            $productname = "Webspace";
            break;
        case 5:
            $productname = "App";
            break;
    }
    if($service["autorenew"] == 1){
        $price = $service["price"] * (1 - $service["discount"]);
        if($user->pay("Automatische Service verlängerung. Für Service " . $service["id"],$price, $dependencyInjector, true, $service["id"])){
            $mail->addmail("service_successautoextend", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "servicename" => $productname]);
            $masterdatabase->update("service_main", [
                "expire_email" => 0,
                "expire_at" => date('Y-m-d H:i:s', strtotime($service["expire_at"] . ' + 30 days')),
                "delete_at" => null,
            ], [
                "id" => $service["id"]
            ]);
            Functions::sendDataToDiscordFeed("Automatische Service Verlängerung", "Ein " . $productname . " wurde Automatisch für " . $user->getVorname() . " " . $user->getNachname() . " verlängert.", "https://prohosting24.de/admin/kunden/" . $user->getID(), [[
                "name" => "Kosten",
                "value" => strval($price) . "€"
            ]]);
            Functions::errorLog("systemServiceExpireAutorenew","Service expire autorenew", [
                "serviceid" => $service["id"],
                "productname" => $productname,
                "userid" => $user->getID(),
                "username" => $user->getUsername(),
                "name" => $user->getVorname() . " " . $user->getNachname(),
                "newExpireAt" => date('Y-m-d H:i:s', strtotime($service["expire_at"] . ' + 30 days'))
            ], false);
            $autoRenew = true;
        } else {
            $mail->addmail("service_noautoextend_expire3days", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "servicename" => $productname]);
        }
    }
    if(!$autoRenew){
        $mail->addmail("service_expire3days", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname(), "servicename" => $productname]);
        $masterdatabase->update("service_main", [
            "expire_email" => 1,
        ], [
            "id[=]" => $service["id"],
        ]);
        Functions::errorLog("systemServiceExpire3Days","Service expire 3 days", [
            "serviceid" => $service["id"],
            "productname" => $productname,
            "userid" => $user->getID(),
            "username" => $user->getUsername(),
            "name" => $user->getVorname() . " " . $user->getNachname()
        ], false);
        Functions::sendDataToDiscordFeed("Dienst wird in 3 Tagen abgeschaltet", "Ein " . $productname . " wird in 3 Tagen für " . $user->getVorname() . " " . $user->getNachname() . " abgeschaltet.", "https://prohosting24.de/admin/kunden/" . $user->getID(), [[
            "name" => "ServiceId",
            "value" => $service["id"]
        ]]);
    }
}
