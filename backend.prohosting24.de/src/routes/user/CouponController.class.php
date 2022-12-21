<?php


class CouponController extends RouteTarget
{
    public function getCouponsByUserId()
    {
        Functions::checkArray(["userid"],$_POST);

        $coupon = new Coupon($this->dependencyInjector, null);

        $couponList = $coupon->getAll(["userid" => $_POST["userid"], "status" => 1], true);

        $returnList = [];

        foreach ($couponList as $entry){
            $returnList[] = [
                "name" => $entry["name"],
                "amount" => Functions::niceMoneyNumber($entry["amount"]),
                "created_on" => niceDate($entry["created_on"])
            ];
        }


        $this->dependencyInjector->getResponse()->setresponse($returnList);
    }

    public function orderCoupon()
    {
        Functions::checkArray(["userid", "amount"],$_POST);
        $_POST["amount"] = str_replace(",", ".", $_POST["amount"]);

        if ($_POST["amount"] > (int) $this->dependencyInjector->getConfig()->getconfigvalue("max_add_amount")) {
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("couponmaxeuro"));
        }

        if ($_POST["amount"] < 1) {
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("couponmineuro"));
        }

        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(), $_POST["userid"]);

        $sevdeskApi = new SevDeskApiClient($this->dependencyInjector);

        $userNew = new UserNew($this->dependencyInjector, $_POST["userid"]);

        $invoiceList = $sevdeskApi->getInvoiceList($userNew);

        if(count($invoiceList) == 0){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("couponnoinvoice"));
        }

        $id = "PH24-" . random_str(4, "0123456789") . "-". random_str(4, "0123456789") . "-". random_str(4, "0123456789"). "-". random_str(4, "0123456789");
        $coupon = new Coupon($this->dependencyInjector, null);

        $couponList = $coupon->getAll(["name" => $id, "status" => 1], false);

        if(count($couponList) != 0){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("error"));
        }

        if(!$user->pay("Gutschein - " . $id,$_POST["amount"],$this->dependencyInjector)){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("notenoughcredit"));
        }

        $paymentId = $this->dependencyInjector->getDatabase()->id();

        $coupon->setValue("userid", $_POST["userid"]);
        $coupon->setValue("amount", $_POST["amount"]);
        $coupon->setValue("status", 1);
        $coupon->setValue("name", $id);
        $coupon->create();
        Functions::sendDataToDiscordFeed(
            "Neuer Coupon",
            "Der Nutzer " . $user->getUsername() . " hat einen Coupon im Wert von " . Functions::niceMoneyNumber($_POST["amount"]). " gekauft.",
            "https://prohosting24.de/admin/kunden/" . $user->getID()
        );
        $creditLog = new CreditLog($this->dependencyInjector, $paymentId);
        $creditLog->setValue("serviceid", $coupon->getValue("id"));
        $creditLog->update();
    }

    public function redeemCoupon()
    {
        Functions::checkArray(["userid", "id"],$_POST);

        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(), $_POST["userid"]);

        $ratelimit = new RateLimit($this->dependencyInjector->getDatabase());
        if($ratelimit->check("redeemcoupon",$_POST["userid"], null)){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("ratelimitreached"));
        }

        $coupon = new Coupon($this->dependencyInjector, null);
        $couponList = $coupon->getAll(["name" => $_POST["id"], "status" => 1]);
        if(count($couponList) != 1){
            $ratelimit->add("redeemcoupon",$_POST["userid"],null,2, "30 minutes");
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("coupondoesnotexist"));
        }
        $coupon = $couponList[0];

        if($coupon->getValue("oldusers") != 1){
            if(strtotime($user->getCreated_on()) < strtotime($coupon->getValue("created_on"))){
                $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("coupononlynewusers"));
            }
        }

        if($coupon->getValue("newusers") != 1){
            if(strtotime($user->getCreated_on()) > strtotime($coupon->getValue("created_on"))){
                $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("coupononlyoldusers"));
            }
        }

        $couponUsages = new CouponUses($this->dependencyInjector, null);

        $usageList = $couponUsages->getAll(["coupon" => $coupon->getValue("id")]);

        $usages = count($usageList);

        if($usages >= $coupon->getValue("maxusages")){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("couponused"));
        }

        $usageCount = 0;

        foreach ($usageList as $usage){
            if($usage->getValue("usedby") == $user->getID()){
                $usageCount++;
            }
        }

        if($usageCount >= $coupon->getValue("maxusagesperuser")){
            $this->dependencyInjector->getResponse()->fail(1, $this->dependencyInjector->getLang()->getString("couponused"));
        }

        if($coupon->getValue("maxusages") == 1){
            $coupon->setValue("status", 0);
            $coupon->setValue("usedby", $_POST["userid"]);
        }
        $coupon->update();

        $couponUsages = new CouponUses($this->dependencyInjector, null);

        $couponUsages->setValue("usedby", $_POST["userid"]);
        $couponUsages->setValue("coupon", $coupon->getValue("id"));
        $couponUsages->create();


        $user->changeCredit($this->dependencyInjector->getDatabase(),$coupon->getValue("amount"),"Gutschein - " . $coupon->getValue("name"),$coupon->getValue("id"));
        Functions::sendDataToDiscordFeed(
            "Coupon eingelöst",
            "Der Nutzer " . $user->getUsername() . " hat einen Coupon im Wert von " . Functions::niceMoneyNumber($coupon->getValue("amount")). " eingelöst.",
            "https://prohosting24.de/admin/kunden/" . $user->getID()
        );
    }

}