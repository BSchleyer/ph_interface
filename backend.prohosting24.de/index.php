<?php


$router->addroute("sessiondelete", "main/sessiondelete.php");
$router->addroute("createuser", "main/createuser.php");
$router->addroute("loginuser", "main/loginuser.php");
$router->addroute("userverify", "main/userverify.php");
$router->addroute("getrights", "main/getrights.php");
$router->addroute("addright", "main/addright.php");
$router->addroute("getgroups", "main/getgroups.php");
$router->addroute("getrechtezugruppen", "main/getrechtezugruppen.php");
$router->addroute("addrighttogroup", "main/addrighttogroup.php");
$router->addroute("removerighttogroup", "main/removerighttogroup.php");
$router->addroute("getuserlist", "main/getuserlist.php");
$router->addroute("getguthabenhistory", "main/getguthabenhistory.php");
$router->addroute("logit", "main/logit.php");
$router->addroute("edituser", "main/edituser.php");
$router->addroute("passwortvergessen", "main/passwortvergessen.php");
$router->addroute("linkresolve", "main/linkresolve.php");
$router->addroute("getlinkinfo", "main/getlinkinfo.php");
$router->addroute("getuserinfo", "main/getuserinfo.php");
$router->addroute("changeguthaben", "main/changeguthaben.php");
$router->addroute("getsessionforuser", "main/getsessionforuser.php");
$router->addroute("changestatus", "main/changestatus.php");
$router->addroute("getservicelist", "main/getservicelist.php");
$router->addroute("updateolduserinfo", "main/updateolduserinfo.php");
$router->addroute("getchangelog", "main/getchangelog.php");
$router->addroute("createnewpin", "main/createnewpin.php");
$router->addroute("admindashboardinfo", "main/admindashboardinfo.php");
$router->addroute("addchangelog", "main/addchangelog.php");
$router->addroute("getactivesessionsforuser", "main/getactivesessionsforuser.php");
$router->addroute("transferservice", "main/transferservice.php");
$router->addroute("lockservice", "main/lockservice.php");
$router->addroute("unlockservice", "main/unlockservice.php");
$router->addroute("add2fa", "main/add2fa.php");
$router->addroute("remove2fa", "main/remove2fa.php");
$router->addroute("stornoservice", "main/stornoservice.php");
$router->addroute("getinvoiceinfo", "main/getinvoiceinfo.php");
$router->addroute("setinvoiceinfo", "main/setinvoiceinfo.php");
$router->addroute("savePassword", "main/savePassword.php");
$router->addroute("getUserDashboardInfo", "main/getUserDashboardInfo.php");


$router->addroute("getnodes", "vserver/getnodes.php");
$router->addroute("vserverstart", "vserver/vserverstart.php");
$router->addroute("getVServerExecList", "vserver/getVServerExecList.php");
$router->addroute("vserverexec", "vserver/vserverexec.php");
$router->addroute("vservertaskinfo", "vserver/vservertaskinfo.php");
$router->addroute("vserverreset", "vserver/vserverreset.php");
$router->addroute("vserverstop", "vserver/vserverstop.php");
$router->addroute("createnode", "vserver/createnode.php");
$router->addroute("createimage", "vserver/createimage.php");
$router->addroute("getimages", "vserver/getimages.php");
$router->addroute("getvservers", "vserver/getvservers.php");
$router->addroute("createvserver", "vserver/createvserver.php");
$router->addroute("getownvservers", "vserver/getownvservers.php");
$router->addroute("getvserverinfos", "vserver/getvserverinfos.php");
$router->addroute("vserverreinstall", "vserver/vserverreinstall.php");
$router->addroute("vservercurrentstats", "vserver/vservercurrentstats.php");
$router->addroute("getvserverlogs", "vserver/getvserverlogs.php");
$router->addroute("getvserveripadressen", "vserver/getvserveripadressen.php");
$router->addroute("renewvserver", "vserver/renewvserver.php");
$router->addroute("getvserverowner", "vserver/getvserverowner.php");
$router->addroute("hidevserver", "vserver/hidevserver.php");
$router->addroute("upgradevserver", "vserver/upgradevserver.php");
$router->addroute("createpacket", "vserver/createpacket.php");
$router->addroute("deletepacket", "vserver/deletepacket.php");
$router->addroute("editpacket", "vserver/editpacket.php");
$router->addroute("getpackets", "vserver/getpackets.php");
$router->addroute("getpacketsDeal", "vserver/getpacketsDeal.php");
$router->addroute("orderpackage", "vserver/orderpackage.php");
$router->addroute("gettrafficforvserver", "vserver/gettrafficforvserver.php");
$router->addroute("getvserverstatistiks", "vserver/getvserverstatistiks.php");
$router->addroute("vservertest", "vserver/test.php");
$router->addroute("getbackupsfromvserver", "vserver/getbackupsfromvserver.php");
$router->addroute("deletebackupvserver", "vserver/deletebackupvserver.php");
$router->addroute("createbackup", "vserver/createbackup.php");
$router->addroute("backupeinspielen", "vserver/backupeinspielen.php");
$router->addroute("vservershutdown", "vserver/vservershutdown.php");
$router->addroute("upgradepacketvserver", "vserver/upgradepacketvserver.php");
$router->addroute("getvserverpassword", "vserver/getvserverpassword.php");
$router->addroute("getlostvms", "vserver/getlostvms.php");
$router->addroute("addipadress", "vserver/addipadress.php");
$router->addroute("getVNCInfo", "vserver/getVNCInfo.php");
$router->addroute("vserverresetpassword", "vserver/vserverresetpassword.php");
$router->addroute("lostBackups", "vserver/lostBackups.php");
$router->addroute("addipv6", "vserver/addipv6.php");
$router->addroute("activateAutoRenew", "vserver/activateAutoRenew.php");
$router->addroute("removeAutoRenew", "vserver/removeAutoRenew.php");
$router->addroute("fixServerIds", "vserver/fixServerIds.php");

$router->addroute("vservercroncreate", "vserver/cron/create.php");
$router->addroute("vservercrondelete", "vserver/cron/delete.php");
$router->addroute("vservercronedit", "vserver/cron/edit.php");
$router->addroute("vservercrongetlog", "vserver/cron/getlog.php");
$router->addroute("vservercrongetbyvserver", "vserver/cron/getbyvserver.php");
$router->addroute("getcronowner", "vserver/cron/getcronowner.php");


$router->addroute("getownservices", "service/getownservices.php");
$router->addroute("saveservicename", "service/saveservicename.php");
$router->addroute("saveservicegroup", "service/saveservicegroup.php");
$router->addroute("getgroupowner", "service/getgroupowner.php");
$router->addroute("getServiceOwner", "service/getServiceOwner.php");
$router->addroute("getServiceOwnerByServiceId", "service/getServiceOwnerByServiceId.php");
$router->addroute("hideService", "service/hideService.php");
$router->addroute("deleteGroup", "service/deleteGroup.php");
$router->addroute("creategroup", "service/creategroup.php");
$router->addroute("editgroup", "service/editgroup.php");


$router->addroute("newsletterUnsubscribe", "newsletter/newsletterUnsubscribe.php");


$router->addroute("getprodukts", "product/getprodukts.php");
$router->addroute("getproduktinfos", "product/getproduktinfos.php");
$router->addroute("ordervserver", "product/ordervserver.php");
$router->addroute("productTest", "product/test.php");


$router->addroute("enableapi", "customer/enableapi.php");
$router->addroute("enablehourlypayment", "customer/enablehourlypayment.php");


$router->addroute("paymenttest", "payment/test.php");
$router->addroute("paymentstart", "payment/start.php");
$router->addroute("paymentfinish", "payment/finish.php");
$router->addroute("gettransaktions", "payment/gettransaktions.php");
$router->addroute("discounttest", "payment/discounttest.php");
$router->addroute("redeemcode", "payment/redeemcode.php");
$router->addroute("checkdiscountcode", "payment/checkdiscountcode.php");
$router->addroute("getinvoice", "payment/getinvoice.php");
$router->addroute("checkextracredit", "payment/checkextracredit.php");
$router->addroute("creatediscount", "payment/creatediscount.php");
$router->addroute("getalldiscounts", "payment/getalldiscounts.php");
$router->addroute("getSales", "payment/getSales.php");
$router->addroute("saveCountrys", "payment/saveCountrys.php");



$router->addroute("createticket", "support/createticket.php");
$router->addroute("answerticket", "support/answerticket.php");
$router->addroute("gettickets", "support/gettickets.php");
$router->addroute("getticketdetails", "support/getticketdetails.php");
$router->addroute("updateticketstatus", "support/updateticketstatus.php");
$router->addroute("assignticketstatus", "support/assignticketstatus.php");
$router->addroute("convertsupportpin", "support/convertsupportpin.php");


$router->addroute("addtemplate", "mail/addtemplate.php");
$router->addroute("gettemplates", "mail/gettemplates.php");
$router->addroute("updatetemplate", "mail/updatetemplate.php");
$router->addroute("gettemplate", "mail/gettemplate.php");
$router->addroute("getemailsbyuserid", "mail/getemailsbyuserid.php");
$router->addroute("massEmails", "mail/massEmails.php");
$router->addroute("getEmailHTML", "mail/getEmailHTML.php");



$router->addroute("orderwebspace", "webspace/order.php");
$router->addroute("getownwebspaces", "webspace/getownwebspaces.php");
$router->addroute("getwebspaceowner", "webspace/getwebspaceowner.php");
$router->addroute("hidewebspace", "webspace/hidewebspace.php");
$router->addroute("getwebspaceinfo", "webspace/getwebspaceinfo.php");
$router->addroute("renewwebspace", "webspace/renewwebspace.php");
$router->addroute("getwebspacelogs", "webspace/getwebspacelogs.php");
$router->addroute("webspacegetsession", "webspace/webspacegetsession.php");
$router->addroute("getdomainlist", "webspace/getdomainlist.php");


$router->addroute("domaintest", "domain/test.php");
$router->addroute("checkdomain", "domain/checkdomain.php");
$router->addroute("getkontaktbyuserid", "domain/getkontaktbyuserid.php");
$router->addroute("addnameserver", "domain/addnameserver.php");
$router->addroute("addkontakt", "domain/addkontakt.php");
$router->addroute("getalltlds", "domain/getalltlds.php");
$router->addroute("oderdomain", "domain/order.php");
$router->addroute("getowndomains", "domain/getowndomains.php");
$router->addroute("getdomainowner", "domain/getdomainowner.php");
$router->addroute("getdomaininfo", "domain/getdomaininfo.php");
$router->addroute("renewdomain", "domain/renewdomain.php");
$router->addroute("changenameserver", "domain/changenameserver.php");
$router->addroute("deletednsentry", "domain/deletednsentry.php");
$router->addroute("editdnsentry", "domain/editdnsentry.php");
$router->addroute("adddnsentry", "domain/adddnsentry.php");
$router->addroute("addrdns", "domain/addrdns.php");
$router->addroute("transferfomain", "domain/transferfomain.php");
$router->addroute("getlostdomains", "domain/getlostdomains.php");
$router->addroute("getdomainlogs", "domain/getdomainlogs.php");
$router->addroute("hidedomain", "domain/hidedomain.php");

$router->addroute("createMailBox", "domain/mailbox/create.php");
$router->addroute("deleteMailBox", "domain/mailbox/delete.php");
$router->addroute("getMailBox", "domain/mailbox/get.php");
$router->addroute("editMailBox", "domain/mailbox/edit.php");
$router->addroute("setMailBox", "domain/mailbox/set.php");


$router->addroute("createlink", "affiliate/createlink.php");
$router->addroute("linkclick", "affiliate/linkclick.php");
$router->addroute("affiliateinfos", "affiliate/infos.php");


$router->addroute("pteroGetProduct", "",true, ["ptero/PteroProductController.class.php", "PteroProductController", "getProduct"]);
$router->addroute("pteroOrderProduct", "",true, ["ptero/PteroProductController.class.php", "PteroProductController", "orderProduct"]);
$router->addroute("pteroGetOwner", "",true, ["ptero/PteroProductController.class.php", "PteroProductController", "pteroGetOwner"]);
$router->addroute("getpteroinfo", "",true, ["ptero/PteroProductController.class.php", "PteroProductController", "getpteroinfo"]);
$router->addroute("pteroRenew", "",true, ["ptero/PteroProductController.class.php", "PteroProductController", "pteroRenew"]);
$router->addroute("pteroChangeService", "",true, ["ptero/PteroProductController.class.php", "PteroProductController", "changeService"]);
$router->addroute("pteroGetPackets", "",true, ["ptero/PteroProductController.class.php", "PteroProductController", "pteroGetPackets"]);
$router->addroute("pteroStop", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroStop"]);
$router->addroute("pteroStart", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroStart"]);
$router->addroute("pteroShutdown", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroShutdown"]);
$router->addroute("pteroCommand", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroCommand"]);
$router->addroute("pteroWebsocket", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroWebsocket"]);
$router->addroute("pteroGetBackups", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroGetBackups"]);
$router->addroute("pteroDeleteBackup", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroDeleteBackup"]);
$router->addroute("pteroGetBackupLink", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroGetBackupLink"]);
$router->addroute("pteroCreateBackup", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroCreateBackup"]);
$router->addroute("pteroReinstall", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroReinstall"]);
$router->addroute("pteroGetNetwork", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroGetNetwork"]);
$router->addroute("pteroGetVariables", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroGetVariables"]);
$router->addroute("pteroSetVariables", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroSetVariables"]);
$router->addroute("pteroGetSFTP", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "pteroGetSFTP"]);
$router->addroute("deleteEmptyAllocations", "",true, ["ptero/PteroServiceController.class.php", "PteroServiceController", "deleteEmptyAllocations"]);

$router->addroute("cronVServerQueueCheckTaskStatus", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "checkTaskStatus"]);
$router->addroute("cronVServerQueueStart", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "start"]);
$router->addroute("cronVServerQueueReset", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "reset"]);
$router->addroute("cronVServerQueueStop", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "stop"]);
$router->addroute("cronVServerQueueShutdown", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "shutdown"]);
$router->addroute("cronVServerQueueDelete", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "delete"]);
$router->addroute("cronVServerQueueInstallStep1", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "installStep1"]);
$router->addroute("cronVServerQueueInstallStep2", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "installStep2"]);
$router->addroute("cronVServerQueueMigrateServer", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "migrateServer"]);
$router->addroute("cronVServerHourlyCalc", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "calcHourly"]);
$router->addroute("cronVServerApplyConfig", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "applyConfig"]);
$router->addroute("cronVServerBackupCreate", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "backupCreate"]);
$router->addroute("cronVServerBackupDelete", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "backupDelete"]);
$router->addroute("cronVServerBackupRedeploy", "",true, ["cron/VServerQueueController.class.php", "VServerQueueController", "backupRedeploy"]);

$router->addroute("userSettingCreateKey", "",true, ["user/SettingsController.class.php", "SettingsController", "createSSHKey"]);
$router->addroute("userSettingDeleteKey", "",true, ["user/SettingsController.class.php", "SettingsController", "deleteSSHKey"]);
$router->addroute("userSettingGetKeys", "",true, ["user/SettingsController.class.php", "SettingsController", "getSSHKeys"]);
$router->addroute("userSettingGetKeyOwner", "",true, ["user/SettingsController.class.php", "SettingsController", "getSSHKeyOwner"]);

$router->addroute("getAccessListService", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessList"]);
$router->addroute("getAccessUserOwner", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessUserOwner"]);
$router->addroute("getAccessUserRights", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessUserRights"]);
$router->addroute("deleteAccessUser", "",true, ["user/AccessUserController.class.php", "AccessUserController", "deleteAccessUser"]);
$router->addroute("getAccessByUserId", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessByUserId"]);
$router->addroute("saveAccessRequest", "",true, ["user/AccessUserController.class.php", "AccessUserController", "saveAccessRequest"]);
$router->addroute("getAccessUserTarget", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessUserTarget"]);
$router->addroute("acceptAccessUser", "",true, ["user/AccessUserController.class.php", "AccessUserController", "acceptAccessUser"]);
$router->addroute("getAccessUserInfo", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessUserInfo"]);
$router->addroute("getAccessUserInfoByProduct", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessUserInfoByProduct"]);
$router->addroute("getAccessByOwnerUserId", "",true, ["user/AccessUserController.class.php", "AccessUserController", "getAccessByOwnerUserId"]);

$router->addroute("getAccessListRights", "",true, ["user/AccessRightsController.class.php", "AccessRightsController", "getAll"]);

$router->addroute("createAccessRequest", "",true, ["user/AccessRequestController.class.php", "AccessRequestController", "createAccessRequest"]);


$router->addroute("getOpenPositions", "",true, ["user/CreditLimitController.class.php", "CreditLimitController", "getOpenPositions"]);

$router->addroute("vServerKeysGet", "",true, ["vserver/VServerKeysController.class.php", "VServerKeysController", "get"]);
$router->addroute("vServerKeysCreate", "",true, ["vserver/VServerKeysController.class.php", "VServerKeysController", "create"]);
$router->addroute("vServerKeysDelete", "",true, ["vserver/VServerKeysController.class.php", "VServerKeysController", "delete"]);


$router->addroute("getVServerHardwareInfo", "",true, ["vserver/VServerHardwareController.class.php", "VServerHardwareController", "getVServerHardwareInfo"]);
$router->addroute("deleteDiskvServer", "",true, ["vserver/VServerHardwareController.class.php", "VServerHardwareController", "deleteDiskvServer"]);
$router->addroute("mountDiskvServer", "",true, ["vserver/VServerHardwareController.class.php", "VServerHardwareController", "mountDiskvServer"]);
$router->addroute("saveBootOrdervServer", "",true, ["vserver/VServerHardwareController.class.php", "VServerHardwareController", "saveBootOrdervServer"]);

$router->addroute("hourlyCreateVServer", "",true, ["product/HourlyController.class.php", "HourlyController", "createVServer"]);
$router->addroute("hourlyDeleteVServer", "",true, ["product/HourlyController.class.php", "HourlyController", "deleteVServer"]);
$router->addroute("hourlyCalcService", "",true, ["product/HourlyController.class.php", "HourlyController", "calcService"]);
$router->addroute("hourlyCalcServiceDisplay", "",true, ["product/HourlyController.class.php", "HourlyController", "calcServiceDisplay"]);
$router->addroute("hourlyUpgradeVServer", "",true, ["product/HourlyController.class.php", "HourlyController", "upDowngrade"]);

$router->addroute("invoiceGetList", "",true, ["invoice/InvoiceController.class.php", "InvoiceController", "getList"]);
$router->addroute("invoiceGetDetailsPDF", "",true, ["invoice/InvoiceController.class.php", "InvoiceController", "getDetailsPDF"]);
$router->addroute("invoiceGetDetails", "",true, ["invoice/InvoiceController.class.php", "InvoiceController", "getDetails"]);
$router->addroute("invoiceDelete", "",true, ["invoice/InvoiceController.class.php", "InvoiceController", "deleteInvoice"]);
$router->addroute("invoiceChangeStatus", "",true, ["invoice/InvoiceController.class.php", "InvoiceController", "changeStatus"]);

$router->addroute("getLanguageList", "",true, ["language/LanguageController.class.php", "LanguageController", "getLanguageList"]);
$router->addroute("getFullLanguageList", "",true, ["language/LanguageController.class.php", "LanguageController", "getFullLanguageList"]);


$router->addroute("createDonationLink", "",true, ["user/DonateController.class.php", "DonateController", "createDonationLink"]);
$router->addroute("deleteDonationLink", "",true, ["user/DonateController.class.php", "DonateController", "deleteDonationLink"]);
$router->addroute("getDonationLinksByUserId", "",true, ["user/DonateController.class.php", "DonateController", "getDonationLinksByUserId"]);
$router->addroute("getDonationLinkByName", "",true, ["user/DonateController.class.php", "DonateController", "getDonationLinkByName"]);
$router->addroute("getDonationLinkById", "",true, ["user/DonateController.class.php", "DonateController", "getDonationLinkById"]);
$router->addroute("getDonationsByUserId", "",true, ["user/DonateController.class.php", "DonateController", "getDonationsByUserId"]);
$router->addroute("getDonationLinkStatistics", "",true, ["user/DonateController.class.php", "DonateController", "getDonationLinkStatistics"]);
$router->addroute("addDonationLinkClick", "",true, ["user/DonateController.class.php", "DonateController", "addDonationLinkClick"]);

$router->addroute("startDonation", "",true, ["user/DonateController.class.php", "DonateController", "startDonation"]);
$router->addroute("finishDonation", "",true, ["user/DonateController.class.php", "DonateController", "finishDonation"]);

$router->addroute("getCouponsByUserId", "",true, ["user/CouponController.class.php", "CouponController", "getCouponsByUserId"]);
$router->addroute("orderCoupon", "",true, ["user/CouponController.class.php", "CouponController", "orderCoupon"]);
$router->addroute("redeemCoupon", "",true, ["user/CouponController.class.php", "CouponController", "redeemCoupon"]);

Functions::$dependencyInjector = $dependencyInjector;


if (!$router->checkroute($funktion)) {
	$response->setfail(true, "This function does not exist");
    Functions::errorLog("systemError", "This function does not exist", ["function" => $funktion]);
	print_r(json_encode($response->getresponsearray()));
	die();
}

try {
	$router->sendclient($funktion, $response, $config, $masterdatabase, $dependencyInjector);
} catch (Exception $e) {
    Functions::errorLog("systemError", "Error In Code", $e);
    $response->setfail(true, "Error in Code");
    die();
}


print_r(json_encode($response->getresponsearray()));
die();
