<?php


class DonateController extends RouteTarget
{
    public function createDonationLink()
    {
        Functions::checkArray(["name","userid","displayName"],$_POST);

        $donationLink = new DonationLink($this->dependencyInjector, null);

        $donationLinkList = $donationLink->getAll(["name" => $_POST["name"], "status" => 1]);
        if(count($donationLinkList) != 0){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinknameallreadyinuse"));
        }

        if (preg_match("/[^a-zA-Z0-9]+/", $_POST["name"])) {
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinknamenotallowed"));
        }


        $allByUser = $donationLink->getAll(["userid" => $donationLink->getValue("userid"), "status" => 1]);
        if (count($allByUser) >= $this->dependencyInjector->getConfig()->getconfigvalue("donateLinkLimit")) {
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinklimitreached"));
        }
        $blacklist = $this->dependencyInjector->getConfig()->getconfigvalue("donateLinkBlacklist");
        foreach ($blacklist as $entry) {
            
            if (strpos($_POST["name"], $entry) !== false) {
                $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinknamenotallowed"));
            }
        }
        if(strlen($_POST["name"]) > $this->dependencyInjector->getConfig()->getconfigvalue("donateLinkMaxChars")){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinktolong"));
        }
        if(strlen($_POST["name"]) < $this->dependencyInjector->getConfig()->getconfigvalue("donateLinkMinChars")){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinktoshort"));
        }
        $_POST["displayName"] = htmlspecialchars($_POST["displayName"]);
        if(strlen($_POST["displayName"]) > $this->dependencyInjector->getConfig()->getconfigvalue("donateLinkMaxChars")){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationdisplaynametolong"));
        }
        if(strlen($_POST["displayName"]) < $this->dependencyInjector->getConfig()->getconfigvalue("donateLinkMinChars")){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationdisplaynametoshort"));
        }

        $donationLink->setValue("userid", $_POST["userid"]);
        $donationLink->setValue("name", $_POST["name"]);
        $donationLink->setValue("displayname", $_POST["displayName"]);
        $donationLink->setValue("status", 1);
        $donationLink->create();
    }

    public function deleteDonationLink()
    {
        Functions::checkArray(["id"],$_POST);

        $donationLink = new DonationLink($this->dependencyInjector, $_POST["id"]);
        $donationLink->setValue("status",0);
        $donationLink->update();
    }

    public function getDonationLinksByUserId()
    {
        Functions::checkArray(["userid"],$_POST);

        $donationLink = new DonationLink($this->dependencyInjector, null);

        $donationLinkList = $donationLink->getAll(["userid" => $_POST["userid"], "status" => 1], true);

        $this->dependencyInjector->getResponse()->setresponse($donationLinkList);
    }

    public function getDonationLinkByName()
    {
        Functions::checkArray(["name"],$_POST);

        $donationLink = new DonationLink($this->dependencyInjector, null);

        $donationLinkList = $donationLink->getAll(["name" => $_POST["name"], "status" => 1], true);

        if (count($donationLinkList) != 1){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinknotfound"));
        }
        $this->dependencyInjector->getResponse()->setresponse($donationLinkList[0]);
    }

    public function getDonationLinkById()
    {
        Functions::checkArray(["id"],$_POST);

        $donationLink = new DonationLink($this->dependencyInjector, null);

        $donationLinkList = $donationLink->getAll(["id" => $_POST["id"], "status" => 1], true);

        if (count($donationLinkList) != 1){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("donationlinknotfound"));
        }
        $this->dependencyInjector->getResponse()->setresponse($donationLinkList[0]);
    }

    public function getDonationLinkStatistics()
    {
        Functions::checkArray(["userid"],$_POST);

        $donationLink = new DonationLink($this->dependencyInjector, null);
        $donationLinkList = $donationLink->getAll(["userid" => $_POST["userid"], "status" => 1], true);

        $donationLinkIds = [];

        foreach ($donationLinkList as $link){
            $donationLinkIds[] = $link["id"];
        }

        $donation = new Donations($this->dependencyInjector, null);
        $donationList = $donation->getAll(["linkid" => $donationLinkIds], true);

        $donationStats = [
            "donationCount" => 0,
            "donationAmount" => 0,
            "clicks" => 0
        ];

        foreach ($donationList as $donation){
            $donationStats["donationCount"]++;
            $donationStats["donationAmount"] += $donation["amount"];
        }
        $donationStats["donationAmount"] = Functions::niceMoneyNumber($donationStats["donationAmount"]);

        $donationListClicks = new DonationLinkClicks($this->dependencyInjector, null);
        $donationStats["clicks"] = $donationListClicks->count(["linkid" => $donationLinkIds]);

        $this->dependencyInjector->getResponse()->setresponse($donationStats);
    }

    public function startDonation()
    {
        Functions::checkArray(["amount", "method","reason","donationLink"], $_POST);
        $_POST["amount"] = str_replace(",", ".", $_POST["amount"]);

        $_POST["amount"] = intval($_POST["amount"]);

        if(!is_int($_POST["amount"])) {
            $this->dependencyInjector->getResponse()->fail(200, $this->dependencyInjector->getLang()->getString("donationenteramount"));
        }
        if ($_POST["amount"] < 1) {
            $this->dependencyInjector->getResponse()->fail(200, $this->dependencyInjector->getLang()->getString("donatemineuro"));
        }

        if ($_POST["amount"] > $this->dependencyInjector->getConfig()->getconfigvalue("max_add_amount")) {
            $this->dependencyInjector->getResponse()->fail(200, $this->dependencyInjector->getLang()->getString("donatemaxeuro"));
        }

        $link = New DonationLink($this->dependencyInjector, null);

        $link = $link->getAll(["name" => $_POST["donationLink"], "status" => 1]);

        if(count($link) != 1){
            $this->dependencyInjector->getResponse()->fail(200, $this->dependencyInjector->getLang()->getString("donatenovalidlink"));
        }

        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(), $link[0]->getValue("userid"));

        $payment = new Payment($this->dependencyInjector->getConfig(),  $this->dependencyInjector);
        $status = $payment->create($_POST["method"], $_POST["amount"], "Prohosting24.de - Guthabenaufladung",0, $this->dependencyInjector->getDatabase(), $user, 0, $_POST["donationLink"]);
        if (!$status) {
            $this->dependencyInjector->getResponse()->fail(200, $this->dependencyInjector->getLang()->getString("donateerrorduringcreation"));
        }
        $this->dependencyInjector->getResponse()->setresponse($status);
    }

    public function finishDonation()
    {
        Functions::checkArray(["paymentid", "type","reason"], $_POST);
        if(!isset($_POST["payer"])){
            $_POST["payer"] = "";
        }

        $payment = new Payment($this->dependencyInjector->getConfig(), $this->dependencyInjector);
        $user = new User();

        $reason = htmlspecialchars($_POST["reason"]);
        $status = $payment->finish($_POST["type"], $this->dependencyInjector->getDatabase(), ["id" => $_POST["paymentid"], "payer" => $_POST["payer"]], $user,$this->dependencyInjector, $reason);
        $this->dependencyInjector->getResponse()->setresponse($status);

    }

    public function getDonationsByUserId()
    {
        Functions::checkArray(["userid"], $_POST);
        $donationLink = new DonationLink($this->dependencyInjector, null);
        $donationLinkList = $donationLink->getAll(["userid" => $_POST["userid"], "status" => 1], true);

        $donationLinkIds = [];

        $donationLinkListSorted = [];

        foreach ($donationLinkList as $link){
            $donationLinkIds[] = $link["id"];
            $donationLinkListSorted[$link["id"]] = $link;
        }

        $donation = new Donations($this->dependencyInjector, null);
        $donationList = $donation->getAll(["linkid" => $donationLinkIds, "LIMIT" => 10], true);

        $donationListReturn = [];

        foreach ($donationList as $donation){
            $donationListReturn[] = [
                "amount" => Functions::niceMoneyNumber($donation["amount"]),
                "reason" => $donation["reason"],
                "linkName" => $donationLinkListSorted[$donation["linkid"]]["name"],
                "displayname" => $donationLinkListSorted[$donation["linkid"]]["displayname"],
                "created_on" => niceDate($donation["created_on"])
            ];
        }

        $this->dependencyInjector->getResponse()->setresponse($donationListReturn);
    }

    public function addDonationLinkClick()
    {
        Functions::checkArray(["name","ip"],$_POST);

        $donationLink = new DonationLink($this->dependencyInjector, null);

        $donationLinkList = $donationLink->getAll(["name" => $_POST["name"], "status" => 1], false);
        $donationLink = $donationLinkList[0];

        $donationLinkClick = new DonationLinkClicks($this->dependencyInjector, null);
        $donationLinkClick->setValue("linkid", $donationLink->getValue("id"));
        $donationLinkClick->setValue("ip", $_POST["ip"]);
        $donationLinkClick->create();
    }

}