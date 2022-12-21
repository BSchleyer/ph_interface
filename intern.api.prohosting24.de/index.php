<?php


$router->addroute("createuser", "main/createuser.php");
$router->addroute("getuserinfo", "main/getowninfo.php");
$router->addroute("login", "main/login.php");
$router->addroute("getrights", "main/getrights.php");
$router->addroute("addright", "main/addright.php");
$router->addroute("getgroups", "main/getgroups.php");
$router->addroute("addgroup", "main/addgroup.php");
$router->addroute("deletegroup", "main/deletegroup.php");
$router->addroute("getrechtezugruppen", "main/getrechtezugruppen.php");
$router->addroute("addrighttogroup", "main/addrighttogroup.php");
$router->addroute("removerighttogroup", "main/removerighttogroup.php");
$router->addroute("register", "main/register.php");
$router->addroute("getuserlist", "main/getuserlist.php");
$router->addroute("getcredithistory", "main/getguthabenhistory.php");
$router->addroute("getexternapilogs", "main/getexternapilogs.php");
$router->addroute("savesettings", "main/savesettings.php");
$router->addroute("passwordforgot", "main/passwortvergessen.php");
$router->addroute("linkresolve", "main/linkresolve.php");
$router->addroute("getuserinfoadmin", "main/getuserinfo.php");
$router->addroute("changeguthaben", "main/changeguthaben.php");
$router->addroute("getsessionforuser", "main/getsessionforuser.php");
$router->addroute("changestatus", "main/changestatus.php");
$router->addroute("getservicelist", "main/getservicelist.php");
$router->addroute("getServiceList", "service/getServiceList.php");
$router->addroute("updateolduserinfo", "main/updateolduserinfo.php");
$router->addroute("getownservices", "main/getownservices.php");
$router->addroute("createnewpin", "main/createnewpin.php");
$router->addroute("getchangelog", "main/getchangelog.php");
$router->addroute("addchangelog", "main/addchangelog.php");
$router->addroute("getsessions", "main/getsessions.php");
$router->addroute("transferservice", "main/transferservice.php");
$router->addroute("lockservice", "main/lockservice.php");
$router->addroute("unlockservice", "main/unlockservice.php");
$router->addroute("stornoservice", "main/stornoservice.php");
$router->addroute("add2fa", "main/add2fa.php");
$router->addroute("remove2fa", "main/remove2fa.php");
$router->addroute("setinvoiceinfo", "main/setinvoiceinfo.php");
$router->addroute("savePassword", "main/savePassword.php");


$router->addroute("getvserveripadressen", "vserver/getvserveripadressen.php");
$router->addroute("getvserverlogs", "vserver/getvserverlogs.php");
$router->addroute("vservercurrentstats", "vserver/vservercurrentstats.php");
$router->addroute("getnodes", "vserver/getnodes.php");
$router->addroute("getvserverinfos", "vserver/getvserverinfos.php");
$router->addroute("vserverstop", "vserver/vserverstop.php");
$router->addroute("vserverexec", "vserver/vserverexec.php");
$router->addroute("vserverstart", "vserver/vserverstart.php");
$router->addroute("vserverreset", "vserver/vserverreset.php");
$router->addroute("createnode", "vserver/createnode.php");
$router->addroute("createimage", "vserver/createimage.php");
$router->addroute("getimages", "vserver/getimages.php");
$router->addroute("getips", "vserver/getips.php");
$router->addroute("getVServerExecList", "vserver/getVServerExecList.php");
$router->addroute("getVServerExecInfo", "vserver/getVServerExecInfo.php");
$router->addroute("addsubnet", "vserver/addsubnet.php");
$router->addroute("getownvservers", "vserver/getownvservers.php");
$router->addroute("vserverreinstall", "vserver/vserverreinstall.php");
$router->addroute("renewvserver", "vserver/renewvserver.php");
$router->addroute("hideownvserver", "vserver/hideownvserver.php");
$router->addroute("getpackets", "vserver/getpackets.php");
$router->addroute("createpacket", "vserver/createpacket.php");
$router->addroute("editpacket", "vserver/editpacket.php");
$router->addroute("deletepacket", "vserver/deletepacket.php");
$router->addroute("getpacketsfrontend", "vserver/getpacketsfrontend.php");
$router->addroute("getpacketsDeal", "vserver/getpacketsfrontendDeal.php");
$router->addroute("orderpackage", "vserver/orderpackage.php");
$router->addroute("gettrafficforvserver", "vserver/gettrafficforvserver.php");
$router->addroute("getangriffevserver", "vserver/getangriffevserver.php");
$router->addroute("getAttacksVServer", "vserver/getangriffevserver.php");
$router->addroute("getvserverstatistiks", "vserver/getvserverstatistiks.php");
$router->addroute("getvserverinfose", "vserver/getvserverinfose.php");
$router->addroute("getbackupsfromvserver", "vserver/getbackupsfromvserver.php");
$router->addroute("deletebackupvserver", "vserver/deletebackupvserver.php");
$router->addroute("createbackup", "vserver/createbackup.php");
$router->addroute("backupeinspielen", "vserver/backupeinspielen.php");
$router->addroute("restoreBackupVServer", "vserver/backupeinspielen.php");
$router->addroute("updatevserverbackuphour", "vserver/updatevserverbackuphour.php");
$router->addroute("upgradevserver", "vserver/upgradevserver.php");
$router->addroute("vservershutdown", "vserver/vservershutdown.php");
$router->addroute("upgradepacketvserver", "vserver/upgradepacketvserver.php");
$router->addroute("getvserverpassword", "vserver/getvserverpassword.php");
$router->addroute("getlostvms", "vserver/getlostvms.php");
$router->addroute("addipadress", "vserver/addipadress.php");
$router->addroute("getVNCInfo", "vserver/getVNCInfo.php");
$router->addroute("vserverresetpassword", "vserver/vserverresetpassword.php");
$router->addroute("addipv6", "vserver/addipv6.php");
$router->addroute("activateAutoRenew", "vserver/activateAutoRenew.php");
$router->addroute("removeAutoRenew", "vserver/removeAutoRenew.php");
$router->addroute("getKeysvServer", "vserver/getKeysvServer.php");
$router->addroute("deleteKeysvServer", "vserver/deleteKeysvServer.php");
$router->addroute("createKeysvServer", "vserver/createKeysvServer.php");
$router->addroute("getVServerHardwareInfo", "vserver/getVServerHardwareInfo.php");
$router->addroute("deleteDiskvServer", "vserver/deleteDiskvServer.php");
$router->addroute("mountDiskvServer", "vserver/mountDiskvServer.php");
$router->addroute("saveBootOrdervServer", "vserver/saveBootOrdervServer.php");

$router->addroute("vservercrongetbyvserver", "vserver/cron/getbyvserver.php");
$router->addroute("vservercrongetlog", "vserver/cron/getlog.php");
$router->addroute("vservercrondelete", "vserver/cron/vservercrondelete.php");
$router->addroute("vservercroncreate", "vserver/cron/vservercroncreate.php");
$router->addroute("vservercronedit", "vserver/cron/vservercronedit.php");


$router->addroute("getservices", "service/getservices.php");
$router->addroute("saveservicename", "service/saveservicename.php");
$router->addroute("hideService", "service/hideService.php");
$router->addroute("getHourlyStatsHTML", "service/getHourlyStatsHTML.php");
$router->addroute("getAccesListService", "service/getAccesListService.php");
$router->addroute("getAccessListRights", "service/getAccessListRights.php");
$router->addroute("createAccessRequest", "service/createAccessRequest.php");
$router->addroute("getAccesUserRights", "service/getAccesUserRights.php");
$router->addroute("saveAccessRequest", "service/saveAccessRequest.php");
$router->addroute("accessDelete", "service/accessDelete.php");
$router->addroute("getAccessByUser", "service/getAccessByUser.php");
$router->addroute("accessAccept", "service/accessAccept.php");
$router->addroute("getAccessByOwnerUser", "service/getAccessByOwnerUser.php");
$router->addroute("moveServiceToGroup", "service/moveServiceToGroup.php");
$router->addroute("deleteGroup", "service/deleteGroup.php");
$router->addroute("creategroup", "service/creategroup.php");
$router->addroute("editgroup", "service/editgroup.php");


$router->addroute("enableapi", "customer/enableapi.php");
$router->addroute("enablehourlypayment", "customer/enablehourlypayment.php");


$router->addroute("getproduktinfos", "produkt/getproduktinfos.php");
$router->addroute("ordervserver", "produkt/ordervserver.php");


$router->addroute("getownsupporttickets", "support/getownsupporttickets.php");
$router->addroute("closesupportticket", "support/closesupportticket.php");
$router->addroute("supportticketdetails", "support/supportticketdetails.php");
$router->addroute("answerownticket", "support/answerownticket.php");
$router->addroute("createticket", "support/createticket.php");
$router->addroute("getsupporttickets", "support/getsupporttickets.php");
$router->addroute("closesupportticketadmin", "support/closesupportticketadmin.php");
$router->addroute("assignsupportticketadmin", "support/assignsupportticketadmin.php");
$router->addroute("supportticketdetailsadmin", "support/supportticketdetailsadmin.php");
$router->addroute("answerticketadmin", "support/answerticketadmin.php");
$router->addroute("getticketsforuserid", "support/getticketsforuserid.php");
$router->addroute("getsupportticketsadmin", "support/getsupportticketsadmin.php");
$router->addroute("convertsupportpin", "support/convertsupportpin.php");
$router->addroute("getSupportTickets", "support/getSupportTicketsH.php");
$router->addroute("getSupportTicketDetail", "support/getSupportTicketDetail.php");
$router->addroute("answerTicket", "support/answerTicket.php");


$router->addroute("startpayment", "payment/start.php");
$router->addroute("finishpayment", "payment/finish.php");
$router->addroute("gettransaktions", "payment/gettransaktions.php");
$router->addroute("redeemcode", "payment/redeemcode.php");
$router->addroute("checkdiscountcode", "payment/checkdiscountcode.php");
$router->addroute("getalldiscounts", "payment/getalldiscounts.php");
$router->addroute("creatediscount", "payment/creatediscount.php");
$router->addroute("getCreditHistory", "payment/getCreditHistory.php");


$router->addroute("updatetemplate", "mail/updatetemplate.php");
$router->addroute("gettemplates", "mail/gettemplates.php");
$router->addroute("gettemplate", "mail/gettemplate.php");
$router->addroute("addtemplate", "mail/addtemplate.php");
$router->addroute("getownemails", "mail/getownemails.php");
$router->addroute("gettemplatebyname", "mail/gettemplatebyname.php");
$router->addroute("getEMails", "mail/getEMails.php");


$router->addroute("orderwebspace", "produkt/orderwebspace.php");
$router->addroute("getownwebspaces", "webspace/getownwebspaces.php");
$router->addroute("hideownwebspace", "webspace/hideownwebspace.php");
$router->addroute("getwebspaceinfo", "webspace/getwebspaceinfo.php");
$router->addroute("renewwebspace", "webspace/renewwebspace.php");
$router->addroute("getwebspacelogs", "webspace/getwebspacelogs.php");
$router->addroute("webspacegetsession", "webspace/webspacegetsession.php");
$router->addroute("getdomainlist", "webspace/getdomainlist.php");


$router->addroute("orderteamspeak", "produkt/orderteamspeak.php");
$router->addroute("getownts3server", "teamspeak/getownts3server.php");
$router->addroute("hideownts3", "teamspeak/hideownts3.php");
$router->addroute("ts3start", "teamspeak/ts3start.php");
$router->addroute("ts3stop", "teamspeak/ts3stop.php");
$router->addroute("getts3infos", "teamspeak/getts3info.php");
$router->addroute("getts3logs", "teamspeak/getts3logs.php");
$router->addroute("renewts3", "teamspeak/renewts3.php");
$router->addroute("ts3reinstall", "teamspeak/ts3reinstall.php");
$router->addroute("getts3keys", "teamspeak/getts3keys.php");
$router->addroute("deletets3key", "teamspeak/deletets3key.php");
$router->addroute("ts3getbackups", "teamspeak/ts3getbackups.php");
$router->addroute("ts3createbackup", "teamspeak/ts3createbackup.php");
$router->addroute("ts3deletebackup", "teamspeak/ts3deletebackup.php");
$router->addroute("ts3deploybackup", "teamspeak/ts3deploybackup.php");
$router->addroute("ts3getclientdb", "teamspeak/ts3getclientdb.php");
$router->addroute("ts3getclients", "teamspeak/ts3getclients.php");
$router->addroute("ts3getgroups", "teamspeak/ts3getgroups.php");
$router->addroute("ts3createtoken", "teamspeak/ts3createtoken.php");


$router->addroute("checkdomain", "domain/checkdomain.php");
$router->addroute("getalltlds", "domain/getalltlds.php");
$router->addroute("getowndomains", "domain/getowndomains.php");
$router->addroute("getdomaininfo", "domain/getdomaininfo.php");
$router->addroute("renewdomain", "domain/renewdomain.php");
$router->addroute("changenameserver", "domain/changenameserver.php");
$router->addroute("deletednsentry", "domain/deletednsentry.php");
$router->addroute("adddnsentry", "domain/adddnsentry.php");
$router->addroute("addrdns", "domain/addrdns.php");
$router->addroute("getkontakte", "domain/getkontakte.php");
$router->addroute("addkontakt", "domain/addkontakt.php");
$router->addroute("oderdomain", "produkt/oderdomain.php");
$router->addroute("getlostdomains", "domain/getlostdomains.php");
$router->addroute("getdomainlogs", "domain/getdomainlogs.php");
$router->addroute("hideowndomain", "domain/hideowndomain.php");
$router->addroute("editdnsentry", "domain/editdnsentry.php");

$router->addroute("createMailBox", "domain/mailbox/create.php");
$router->addroute("deleteMailBox", "domain/mailbox/delete.php");
$router->addroute("getMailBox", "domain/mailbox/get.php");
$router->addroute("editMailBox", "domain/mailbox/edit.php");
$router->addroute("setMailBox", "domain/mailbox/set.php");


$router->addroute("createlink", "affiliate/createlink.php");
$router->addroute("affiliateinfos", "affiliate/infos.php");


$router->addroute("getappinfo", "ptero/getappinfo.php");
$router->addroute("appshutdown", "ptero/appshutdown.php");
$router->addroute("appstart", "ptero/appstart.php");
$router->addroute("appstop", "ptero/appstop.php");
$router->addroute("renewapp", "ptero/renewapp.php");
$router->addroute("appcommand", "ptero/appcommand.php");
$router->addroute("appwebsocket", "ptero/appwebsocket.php");
$router->addroute("appgetbackups", "ptero/appgetbackups.php");
$router->addroute("appdeletebackup", "ptero/appdeletebackup.php");
$router->addroute("appgetbackuplink", "ptero/appgetbackuplink.php");
$router->addroute("appcreatebackup", "ptero/appcreatebackup.php");
$router->addroute("appreinstall", "ptero/appreinstall.php");
$router->addroute("appgetnetwork", "ptero/appgetnetwork.php");
$router->addroute("appgetvariables", "ptero/appgetvariables.php");
$router->addroute("appsetvariables", "ptero/appsetvariables.php");
$router->addroute("appgetsftp", "ptero/appgetsftp.php");
$router->addroute("apporder", "ptero/order.php");
$router->addroute("appupgrade", "ptero/appupgrade.php");
$router->addroute("appgetpackets", "ptero/appgetpackets.php");

$router->addroute("getKeys", "user/getKeys.php");
$router->addroute("deleteKey", "user/deleteKey.php");
$router->addroute("createKey", "user/createKey.php");

$router->addroute("createDonationLink", "donation/createDonationLink.php");
$router->addroute("deleteDonationLink", "donation/deleteDonationLink.php");
$router->addroute("getDonationLinks", "donation/getDonationLinks.php");
$router->addroute("startDonation", "donation/startDonation.php");
$router->addroute("finishDonation", "donation/finishDonation.php");
$router->addroute("getDonations", "donation/getDonations.php");

$router->addroute("orderCoupon", "coupon/orderCoupon.php");
$router->addroute("redeemCoupon", "coupon/redeemCoupon.php");
$router->addroute("getCoupons", "coupon/getCoupons.php");



$router->addroute("getInvoiceList", "invoice/getInvoiceList.php");


if (!$router->checkroute($funktion)) {
    $response->setfail(true, "This function does not exist");
    print_r(json_encode($response->getresponsearray()));
    die();
}
$user = new User();


if ($funktion == "login" || $funktion == "register" || $funktion == "getalltlds" || $funktion == "getimages"  || $funktion == "getpacketsDeal" || $funktion == "getpacketsfrontend" || $funktion == "passwordforgot" || $funktion == "linkresolve" || $funktion == "checkdomain" || $funktion == "checkdiscountcode" || $funktion == "startDonation" || $funktion == "finishDonation") {
    $langList = json_decode(file_get_contents('src/configs/languages/langInfo.json'), true);
    $defaultLang = $langList["default"];
    $lang = $defaultLang;
    $selectedLang = $defaultLang;
    global $selectedLang;
    $lang = new LanguageMaster($config, $selectedLang);
    
    $router->sendclient($funktion, $response, $config, $user,$lang);
} else {
    if (isset($_GET["sessionid"])) {
        $sessionid = $_GET["sessionid"];
    } else {
        if (!isset($_POST["sessionid"])) {
            $response->setfail(true, "No Session Id Set");
            print_r(json_encode($response->getresponsearray()));
            die();
        }
        $sessionid = $_POST["sessionid"];
    }
    $apirespond = requestBackend($config, ["sessionid" => $sessionid, "ip" => getclientip()], "userverify");
    if($apirespond == null){
        $response->setfail(true, "Error");
        print_r(json_encode($response->getresponsearray()));
        die();
    }

    if ($apirespond["fail"] == 1) {
        
        $response->setfail(true, $apirespond["error"]);
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    $user->setSessionid($sessionid);
    $user->setEmail($apirespond["response"]["email"]);
    $user->setUsername($apirespond["response"]["username"]);
    $user->setId($apirespond["response"]["id"]);
    $user->setVorname($apirespond["response"]["vorname"]);
    $user->setNachname($apirespond["response"]["nachname"]);
    $user->setGuthaben($apirespond["response"]["guthaben"]);
    $user->setGroups($apirespond["response"]["groups"]);
    $user->setRights($apirespond["response"]["rights"]);
    $user->setIshourly($apirespond["response"]["ishourly"]);
    $user->setCanhourly($apirespond["response"]["canhourly"]);
    $user->setApikey($apirespond["response"]["apikey"]);
    $user->setLang($apirespond["response"]["lang"]);
    $selectedLang = $apirespond["response"]["lang"];
    global $selectedLang;
    $lang = new LanguageMaster($config, $selectedLang);
    
    $router->sendclient($funktion, $response, $config, $user,$lang);
}



print_r(json_encode($response->getresponsearray()));
die();
