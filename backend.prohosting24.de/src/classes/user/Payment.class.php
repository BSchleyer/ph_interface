<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class Payment extends Base
{
    private $paypal = [];
    private $paysafe = [];
    private $sofort = [];

    private $config;

    private $sevDeskApiKey = "";
    private $sevDeskApiUrl = "";

    public function __construct($config,  $dependencyInjector)
    {
        $this->config = $config;
        if (!$config->isset("paypal_clientid")) {
            
            return 0;
        }
        $this->paypal["ClientID"] = $config->getconfigvalue("paypal_clientid");
        if (!$config->isset("paypal_secret")) {
            
            return 0;
        }
        $this->paypal["ClientSecret"] = $config->getconfigvalue("paypal_secret");
        $this->stripe = new \Stripe\StripeClient($config->getconfigvalue("stripe_secret"));
        if (!$config->isset("paypal_mode")) {
            
            return 0;
        }
        $this->paypal["Mode"] = $config->getconfigvalue("paypal_mode");

        $this->paypal["url_success"] = $config->getconfigvalue("paypal_success_url");
        $this->paypal["url_error"] = $config->getconfigvalue("paypal_success_error");

        $this->paysafe["url"] = $config->getconfigvalue("paysafe_url");
        $this->paysafe["url_error"] = $config->getconfigvalue("paysafe_url_error");
        $this->paysafe["Mode"] = $config->getconfigvalue("paysafe_sandbox");
        $this->paysafe["token"] = $config->getconfigvalue("paysafe_key");
        $this->sofort["url"] = $config->getconfigvalue("sofort_url");
        $this->sofort["url_error"] = $config->getconfigvalue("sofort_url_error");
        $this->sofort["project_id"] = $config->getconfigvalue("sofort_project_id");
        $this->sofort["username"] = $config->getconfigvalue("sofort_username");
        $this->sofort["apikey"] = $config->getconfigvalue("sofort_apikey");
        parent::__construct($dependencyInjector);
        $this->sevDeskApiKey = $this->dependencyInjector->getConfig()->getconfigvalue("sevDeskApiKey");
        $this->sevDeskApiUrl = $this->dependencyInjector->getConfig()->getconfigvalue("sevDeskApiUrl");
    }

    public function create($art, $amount, $reason,$invoice, $masterdatabase, $user, $closeSuccess, $donationLink = "")
    {
        if($donationLink != ""){
            $donationLinkSearch = new DonationLink($this->dependencyInjector, null);
            $donationLink = $donationLinkSearch->getAll(["name[=]" => $donationLink, "status" => 1]);

            if(count($donationLink) != 1){
                return "";
            }
            $donationLinkId = $donationLink[0]->getValue("id");
            $this->paypal["url_success"] = $this->dependencyInjector->getConfig()->getconfigvalue("cpURL") ."donate/" .$donationLink[0]->getValue("name");
            $this->paysafe["url"] = $this->dependencyInjector->getConfig()->getconfigvalue("cpURL") ."donate/" .$donationLink[0]->getValue("name");
            $this->paysafe["url_error"] = $this->dependencyInjector->getConfig()->getconfigvalue("cpURL") ."donate/" .$donationLink[0]->getValue("name");
            $this->sofort["url"] = $this->dependencyInjector->getConfig()->getconfigvalue("cpURL") ."donate/" .$donationLink[0]->getValue("name");
            $this->sofort["url_error"] = $this->dependencyInjector->getConfig()->getconfigvalue("cpURL") ."donate/" .$donationLink[0]->getValue("name");
        } else {
            $donationLinkId = 0;
        }
        if($closeSuccess == "1"){
            $this->paypal["url_success"] .= "?closeSuccess=1";
        }
        if (!is_numeric($amount)) {
            return false;
        }
        if ($amount < 1) {
            return false;
        }
        switch ($art) {
            case 'paypal':
                $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        $this->paypal["ClientID"], 
                        $this->paypal["ClientSecret"]
                    )
                );
                $apiContext->setConfig(
                    array(
                        'mode' => $this->paypal["Mode"],
                    )
                );

                $payer = new \PayPal\Api\Payer();
                $payer->setPaymentMethod('paypal');
                $item1 = new \PayPal\Api\Item();
                $item1->setName($reason)
                    ->setCurrency('EUR')
                    ->setQuantity(1)
                    ->setSku(random_str(8, "0123456789"))
                    ->setTax(round($amount / (1 + 19 / 100) * (19 / 100), 2))
                    ->setPrice($amount);
                $itemList = new \PayPal\Api\ItemList();
                $itemList->setItems(array($item1));

                $pamount = new \PayPal\Api\Amount();
                $pamount->setTotal(number_format($amount, 2, ".", ""));
                $pamount->setCurrency('EUR');

                $transaction = new \PayPal\Api\Transaction();
                $transaction->setAmount($pamount)->setItemList($itemList)->setInvoiceNumber(random_str(8, "0123456789"));

                $redirectUrls = new \PayPal\Api\RedirectUrls();
                $redirectUrls->setReturnUrl($this->paypal["url_success"])
                    ->setCancelUrl($this->paypal["url_error"]);

                $payment = new \PayPal\Api\Payment();
                $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setTransactions(array($transaction))
                    ->setRedirectUrls($redirectUrls);

                
                try {
                    $payment->create($apiContext);
                    
                    $masterdatabase->insert("main_payments", [
                        "userid" => $user->getID(),
                        "paymentid" => $payment->getId(),
                        "token" => $payment->getToken(),
                        "amount" => $amount,
                        "amount_t" => (($amount * 0.975) - 0.35),
                        "invoice" => $invoice,
                        "donation" => $donationLinkId
                    ]);
                    return $payment->getApprovalLink();
                } catch (\PayPal\Exception\PayPalConnectionException $ex) {
                    
                    
                }

                break;
            case 'paysafecard':
                
                $client = new SebastianWalker\Paysafecard\Client($this->paysafe["token"]);
                $client->setUrls(new SebastianWalker\Paysafecard\Urls($this->paysafe["url"] . "?payment_id={payment_id}", $this->paysafe["url_error"] . "?payment_id={payment_id}", $this->paysafe["url"] . "?payment_id={payment_id}"));
                $client->setTestingMode($this->paysafe["Mode"]);

                
                $amountt = new SebastianWalker\Paysafecard\Amount($amount, "EUR");
                $payment = new SebastianWalker\Paysafecard\Payment($amountt, $user->getID());
                $payment->create($client);
                $masterdatabase->insert("main_payments", [
                    "userid" => $user->getID(),
                    "paymentid" => $payment->getId(),
                    "token" => 0,
                    "amount" => $amount,
                    "amount_t" => $amount - (($amount * 0.15) * 1.20),
                    "invoice" => $invoice,
                    "donation" => $donationLinkId
                ]);
                return $payment->getAuthUrl();
                break;
            case 'sofort':
                $xml = '<?xml version="1.0" encoding="UTF-8" ?>
                <multipay>
                    <project_id>' . $this->sofort["project_id"] . '</project_id>
                    <interface_version>Ph24-Interface-1.0/Sofort</interface_version>
                    <amount>' . number_format($amount, 2, ".", "") . '</amount>
                    <currency_code>EUR</currency_code>
                    <reasons>
                        <reason>' . $reason . '</reason>
                        <reason>-TRANSACTION-</reason>
                    </reasons>
                    <success_url>' . $this->sofort["url"] . '</success_url>
                    <success_link_redirect>1</success_link_redirect>
                    <abort_url>' . $this->sofort["url_error"] . '</abort_url>
                    <su />
                </multipay>';
                $client = new \GuzzleHttp\Client();
                $request = $client->post("https://api.sofort.com/api/xml", [
                    'headers' => [
                        'Content-Type' => 'text/xml; charset=UTF8',
                        'Authorization' => 'Basic ' . base64_encode($this->sofort["username"] . ':' . $this->sofort["apikey"]),
                    ],
                    'body' => $xml,
                ]);
                $xmlinfo = new SimpleXMLElement($request->getBody()->getContents());
                $link = (string) $xmlinfo->payment_url;
                $paymentid = (string) $xmlinfo->transaction;
                $masterdatabase->insert("main_payments", [
                    "userid" => $user->getID(),
                    "paymentid" => $paymentid,
                    "token" => 0,
                    "amount" => $amount,
                    "amount_t" => $amount - ($amount * 0.019),
                    "invoice" => $invoice,
                    "donation" => $donationLinkId
                ]);
                return $link;
                break;
            case 'stripecheckout':
                return $this->createStripeCheckout($art, $amount, $reason, $invoice, $masterdatabase, $user,$donationLinkId);
                break;
            default:
                return false;
                break;
        }
    }

    public function createInvoice(User $user, $amount, $posList, $paid = true, $timeToPay = 0)
    {
        if($user->getSevdeskid() == null){
            $addsduser = $this->sevDeskClient()->post($this->sevDeskApiUrl.'/Contact?token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'customerNumber' => $user->getID(),
                    'parent' => null,
                    'familyname' => $user->getUsername(),
                    'category' => [
                        'id' => 3,
                        'objectName' => 'Category'
                    ],
                    'description' => null
                ],
            ]);

            $test = json_decode($addsduser->getBody()->getContents(), true);
            $sevDeskId = $test["objects"]["id"];
            $this->sevDeskClient()->post($this->sevDeskApiUrl.'/Contact/addEmail?token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'id' => $sevDeskId,
                    'key' => 8,
                    'value' => $user->getEmail()
                ],
            ]);
            $user->updateSevdeskid($sevDeskId, $this->dependencyInjector->getDatabase());
        }
        $personid = $user->getSevdeskid();
        $nextinvoicenumber = json_decode($this->sevDeskClient()->get($this->sevDeskApiUrl . '/Invoice/Factory/getNextInvoiceNumber/?invoiceType=RE&useNextNumber=1&token=' . $this->sevDeskApiKey)->getBody(), true)["objects"];

        $now = new \DateTime();

        $price = $amount;

        $adress = $user->getVorname() . " " . $user->getNachname() . "\n";


        $invoiceInfo = new InvoiceInfo($this->dependencyInjector, null);

        $invoiceInfo = $invoiceInfo->getAll(["userid" => $user->getID()]);
        $countryId = 1;
        if(count($invoiceInfo) != 0){
            $invoiceInfo = $invoiceInfo[0];

            if($invoiceInfo->getValue("company_name") != "" && $invoiceInfo->getValue("company_name") != null && $invoiceInfo->getValue("company_name") != "company_name"){
                $adress = $invoiceInfo->getValue("company_name"). "\n" . $adress;
            }

            $adress .= $invoiceInfo->getValue("street").  $invoiceInfo->getValue("house_number")."\n";
            $adress .= $invoiceInfo->getValue("city") .  ' ' . $invoiceInfo->getValue("plz")."\n";
            if($invoiceInfo->getValue("country") != "" && $invoiceInfo->getValue("country") != "country"){
                $countryId = $invoiceInfo->getValue("country");
            }
        }

        $createInvoice = json_decode($this->sevDeskClient()->post($this->sevDeskApiUrl . '/Invoice?token=' .$this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                'taxType' => 'default',
                'currency' => 'EUR',
                'invoiceNumber' => $nextinvoicenumber,
                "header" => "Rechnung Nr. " . $nextinvoicenumber,
                'taxText' => 0,
                'taxRate' => 19,
                'taxNumber' => '313/5178/4192',
                'vatNumber' => 'DE318175513',
                'contact' => [
                    'id' => $personid,
                    'objectName' => 'Contact'
                ],
                'contactPerson' => [
                    'id' => 487704,
                    'objectName' => 'SevUser'
                ],
                'timeToPay' => $timeToPay,
                'invoiceDate' => $now->format(\DateTime::ISO8601),
                'status' => 100,
                'discount' => 0,
                'deliveryDate' => $now->format(\DateTime::ISO8601),
                'deliveryDateUnitl' => $now->format(\DateTime::ISO8601),
                'addressCountry' => [
                    "id" => $countryId,
                    "objectName" => 'StaticCountry'
                ],
                'invoiceType' => 'RE',
                'addressName' => $user->getVorname() . " " . $user->getNachname(),
                'checkAccount' => [
                    'id' => 4792190,
                    'objectName' => 'CheckAccount'
                ],
                'checkAccountTransaction' => null,
                'address' => $adress
            ],
        ])->getBody(), true)["objects"]["id"];

        foreach ($posList as $pos){
            $this->sevDeskClient()->post($this->sevDeskApiUrl . '/InvoicePos?token=' . $this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'invoice' => [
                        'id' => $createInvoice,
                        'objectName' => 'Invoice'
                    ],
                    'quantity' => 1,
                    'price' => $pos["price"] / 1.19,
                    'unity' => [
                        'id' => 1,
                        'objectName' => 'Unity'
                    ],
                    'name' => $pos["name"],
                    'showNet' => true,
                    'taxRate' => 19
                ],
            ])->getBody();

        }
        if($paid) {
            $this->sevDeskClient()->put($this->sevDeskApiUrl . '/Invoice/' . $createInvoice . '/bookAmmount?token=' . $this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'ammount' => $price,
                    'date' => time(),
                    'type' => 'N',
                    'createFeed' => false,
                    'checkAccount' => [
                        'id' => 4792190,
                        'objectName' => 'CheckAccount'
                    ],
                    'checkAccountTransaction' => null
                ],
            ])->getBody();
        }

        if($paid){
            $this->sevDeskClient()->post($this->sevDeskApiUrl . '/Invoice/' . $createInvoice . '/sendViaEmail?token=' . $this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'toEmail' => $user->getEmail(),
                    'subject' => "ProHosting24 | " .$this->dependencyInjector->getLang()->getString("invoice") . " " . $nextinvoicenumber,
                    'text' => $this->dependencyInjector->getLang()->getStringWithData("sevdeskinvoicepaid",["invoiceNumber" => $nextinvoicenumber])
                ],
            ])->getBody();
        } else {
            $this->sevDeskClient()->post($this->sevDeskApiUrl . '/Invoice/' . $createInvoice . '/sendViaEmail?token=' . $this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'toEmail' => $user->getEmail(),
                    'subject' => "ProHosting24 | " .$this->dependencyInjector->getLang()->getString("invoice") . " " . $nextinvoicenumber,
                    'text' => $this->dependencyInjector->getLang()->getStringWithData("sevdeskinvoiceunpaid",["invoiceNumber" => $nextinvoicenumber, "payLink" => "https://prohosting24.de/cp/credit/add?invoice=" . $createInvoice])
                ],
            ])->getBody();
        }
    }

    private function sevDeskClient()
    {
        return $client = new \GuzzleHttp\Client([
            'allow_redirects' => false,
            'timeout' => 120,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'verify' => false
        ]);
    }



    private function createStripeCheckout($art, $amount, $reason,$invoice, $masterdatabase, $user,$donationLinkId) {
        try  {
            $masterdatabase->insert("main_payments", [
                "userid" => $user->getID(),
                "paymentid" => '',
                "token" => 0,
                "amount" => $amount,
                "amount_t" => $amount - $amount * 0.014 - 0.25,
                "invoice" => $invoice,
                "donation" => $donationLinkId
            ]);
            $paymentId = $masterdatabase->id();
            $paymentMethods = $user->hasLastschrift() ?
                ['card', 'sepa_debit', 'giropay', 'bancontact', 'eps', 'ideal'] :
                ['card', 'giropay', 'bancontact', 'eps', 'ideal'];
            $session = $this->stripe->checkout->sessions->create( [
                'payment_method_types' => $paymentMethods,
                'success_url' => $this->paysafe["url"] . '?session='.$paymentId,
                'cancel_url' => $this->paysafe["url_error"],
                "billing_address_collection" => "auto",
                "mode" => "payment",
                'line_items' => [
                    [
                        'amount' => $amount * 100,
                        'currency' => 'eur',
                        'name' => 'Guthabenaufladung über Stripe',
                        'quantity' => 1,
                    ]
                ],

            ]);

            $masterdatabase->update("main_payments", [
                "paymentid" => $session->id,
            ],  [
                    "id" => $paymentId
                ]
            );
            return $this->config->getconfigvalue("stripe_redirect") .'?id=' . $session->id;
        } catch(Exception $e) {
            return $this->paysafe["url_error"];
        }
    }

    private function finishStripeCheckout($art, $masterdatabase, $gatewayarray, $user){
        $paymentselect = $masterdatabase->select("main_payments", [
            "userid",
            "amount",
            "paymentid"
        ], [
            "status" => 0,
            "id" => $gatewayarray["id"],
        ]);
        if (count($paymentselect) != 1) {
            return false;
        }

        $session = $this->stripe->checkout->sessions->retrieve($paymentselect[0]["paymentid"]);
        if($session->payment_status != 'paid') return false;


        $user->changeguthaben($masterdatabase, $paymentselect[0]["amount"], "Guthabenaufladung über Stripe");
        $masterdatabase->update("main_payments", [
            "status" => 1,
        ], [
            "id" => $gatewayarray["id"],
        ]);
        return true;

    }

    public function finish($art, $masterdatabase, $gatewayarray, $user, $dependencyInjector, $reason = "")
    {
        $currenttime = date('Y-m-d H:i:s', time());

        $result = $masterdatabase->select("main_credit_add", "*", [
            "active" => 1,
            "expire_at[>]" => $currenttime,
        ]);
        if (count($result) != 1) {
            $extramoney = 0;
        } else {
            $extramoney = $result[0]["percent"];
            $message = $result[0]["message_add"];
        }
        switch ($art) {
            case 'stripecheckout':
                $paymentselect = $masterdatabase->select("main_payments", [
                    "userid",
                    "amount",
                    "paymentid",
                    "invoice",
                    "donation"
                ], [
                    "status" => 0,
                    "id" => $gatewayarray["id"],
                ]);
                if (count($paymentselect) != 1) {
                    return false;
                }

                $session = $this->stripe->checkout->sessions->retrieve($paymentselect[0]["paymentid"]);
                if($session->payment_status != 'paid') return false;


                if($paymentselect[0]["invoice"] != "0"){
                    $this->payInvoice($paymentselect[0]["invoice"], $paymentselect[0]["amount"]);
                } else {
                    if($paymentselect[0]["donation"] != "0"){
                        $this->doDonation($paymentselect[0]["donation"], $paymentselect[0]["amount"], $reason, $gatewayarray["id"]);
                    } else {
                        $user->changeguthaben($masterdatabase, $paymentselect[0]["amount"], "Guthabenaufladung über Stripe");
                    }
                }
                $masterdatabase->update("main_payments", [
                    "status" => 1,
                ], [
                    "id" => $gatewayarray["id"],
                ]);
                break;
            case 'paypal':
                
                $paymentselect = $masterdatabase->select("main_payments", [
                    "userid",
                    "amount",
                    "invoice",
                    "donation"
                ], [
                    "status" => 0,
                    "paymentid" => $gatewayarray["id"],
                ]);
                if (count($paymentselect) != 1) {
                    return false;
                }
                $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        $this->paypal["ClientID"], 
                        $this->paypal["ClientSecret"]
                    )
                );
                $apiContext->setConfig(
                    array(
                        'mode' => $this->paypal["Mode"],
                    )
                );
                $payment = PayPal\Api\Payment::get($gatewayarray["id"], $apiContext);
                $execution = new PayPal\Api\PaymentExecution();
                $execution->setPayerId($gatewayarray["payer"]);
                $payment->execute($execution, $apiContext);

                $payment = PayPal\Api\Payment::get($gatewayarray["id"], $apiContext);

                $status = $payment->getState();
                if ($status != "approved") {
                    echo $payment;
                    return false;
                }
                
                $masterdatabase->update("main_payments", [
                    "status" => 1,
                ], [
                    "paymentid" => $gatewayarray["id"],
                ]);
                if($paymentselect[0]["invoice"] != "0"){
                    $this->payInvoice($paymentselect[0]["invoice"], $paymentselect[0]["amount"]);
                } else {
                    if($paymentselect[0]["donation"] != "0"){
                        $this->doDonation($paymentselect[0]["donation"], $paymentselect[0]["amount"], $reason, $gatewayarray["id"]);
                    } else {
                        $user->changeguthaben($masterdatabase, $paymentselect[0]["amount"], "Guthabenaufladung über PayPal");
                    }
                }
                break;
            case 'paysafecard':
                
                $paymentselect = $masterdatabase->select("main_payments", [
                    "userid",
                    "amount",
                    "invoice",
                    "donation"
                ], [
                    "status" => 0,
                    "paymentid" => $gatewayarray["id"],
                ]);
                if (count($paymentselect) != 1) {
                    return false;
                }
                
                $client = new SebastianWalker\Paysafecard\Client($this->paysafe["token"]);
                $client->setTestingMode($this->paysafe["Mode"]);
                
                $payment = SebastianWalker\Paysafecard\Payment::find($gatewayarray["id"], $client);
                
                if ($payment->isAuthorized()) {
                    
                    $payment->capture($client);
                    if ($payment->isSuccessful()) {
                        $masterdatabase->update("main_payments", [
                            "status" => 1,
                        ], [
                            "paymentid" => $gatewayarray["id"],
                        ]);
                        if($paymentselect[0]["invoice"] != "0"){
                            $this->payInvoice($paymentselect[0]["invoice"], $paymentselect[0]["amount"]);
                        } else {
                            if($paymentselect[0]["donation"] != "0"){
                                $this->doDonation($paymentselect[0]["donation"], $paymentselect[0]["amount"], $reason, $gatewayarray["id"]);
                            } else {
                                $user->changeguthaben($masterdatabase, $paymentselect[0]["amount"], "Guthabenaufladung über Paysafecard");
                            }
                        }
                    } else {
                        return false;
                    }
                } else if ($payment->isFailed()) {
                    return false;
                }
                break;
            case 'sofort':
                
                $paymentselect = $masterdatabase->select("main_payments", [
                    "userid",
                    "amount",
                    "invoice",
                    "donation"
                ], [
                    "status" => 0,
                    "paymentid" => $gatewayarray["id"],
                ]);
                if (count($paymentselect) != 1) {
                    return false;
                }
                
                $xml = '<?xml version="1.0" encoding="UTF-8" ?>
                <transaction_request version="2">
                    <transaction>' . $gatewayarray["id"] . '</transaction>
                </transaction_request>';
                $client = new \GuzzleHttp\Client();
                $request = $client->post("https://api.sofort.com/api/xml", [
                    'headers' => [
                        'Content-Type' => 'text/xml; charset=UTF8',
                        'Authorization' => 'Basic ' . base64_encode($this->sofort["username"] . ':' . $this->sofort["apikey"]),
                    ],
                    'body' => $xml,
                ]);
                $xmlinfo = new SimpleXMLElement($request->getBody()->getContents());
                $status = (string) $xmlinfo->transaction_details->status;
                if ($status != "untraceable") {
                    return false;
                }
                $masterdatabase->update("main_payments", [
                    "status" => 1,
                ], [
                    "paymentid" => $gatewayarray["id"],
                ]);
                if($paymentselect[0]["invoice"] != "0"){
                    $this->payInvoice($paymentselect[0]["invoice"], $paymentselect[0]["amount"]);
                } else {
                    if($paymentselect[0]["donation"] != "0"){
                        $this->doDonation($paymentselect[0]["donation"], $paymentselect[0]["amount"], $reason, $gatewayarray["id"]);
                    } else {
                        $user->changeguthaben($masterdatabase, $paymentselect[0]["amount"], "Guthabenaufladung über Sofort");
                    }
                }
                break;

            default:
                return false;
        }
        if($paymentselect[0]["donation"] != "0"){
            return true;
        }
        if($paymentselect[0]["invoice"] == "0") {
            $this->createInvoice($user, $paymentselect[0]["amount"], [["price" => $paymentselect[0]["amount"], "name" => $this->dependencyInjector->getLang()->getString("addcredit")]]);
        }

        if ($extramoney != 0) {
            $user->changeguthaben($masterdatabase, $paymentselect[0]["amount"] * $extramoney, $message);
        }
        $currentday = date('Y-m-d 0:0:0', time());
        $day = $masterdatabase->sum("main_payments", [
            "amount_t",
        ], [
            "status" => 1,
            "created_on[>]" => $currentday,
        ]);
        if ($day == null) {
            $day = 0;
        }
        sendtodc('Neue Guthabenaufladung.
        User: ' . $user->getVorname() . ' ' . $user->getNachname() . '(' . $user->getID() . ')
        Amount: ' . $paymentselect[0]["amount"] . ' €
        Art: ' . $art . '
        Heutiger Umsatz: ' . $day . ' €', $this->config);

        
        $affiliate = $user->getAffiliatelink();
        if($affiliate != null){
            $affiliateLink = new AffiliateLink($dependencyInjector,$affiliate,"id");
            $affiliatePayout = new AffiliatePayout($dependencyInjector,null,null);
            $affiliatePayout->setValue("linkid", $affiliate);
            $affiliatePayout->setValue("amount", $paymentselect[0]["amount"] * 0.10);
            $affiliatePayout->create();
            $affiliateUser = new User();
            $affiliateUser->load_id($masterdatabase,$affiliateLink->getValue("userid"));
            $affiliateUser->changeguthaben($masterdatabase,$paymentselect[0]["amount"] * 0.10,"Affiliate #" . $affiliatePayout->getValue("id"));

            sendtodc('Affiliate:
            Link: '. $affiliateLink->getValue('link'). '
            User: ' . $affiliateUser->getVorname() . ' ' . $affiliateUser->getNachname() . '(' . $affiliateUser->getID() . ') 
            Amount: ' . $paymentselect[0]["amount"] * 0.10. '
            Id: #' . $affiliatePayout->getValue("id") .'
            ',$this->config);
        }
        return true;
    }

    public function payInvoice($invoice, $money)
    {
        $client = new SevDeskApiClient($this->dependencyInjector);
        $client->payInvoice($invoice, $money);
    }

    public function doDonation($donation, $money, $reason, $paymentId)
    {
        $donation = new DonationLink($this->dependencyInjector, $donation);

        $donationLinksDonation = new Donations($this->dependencyInjector, null);

        $donationLinksDonation->setValue("reason", $reason);
        $donationLinksDonation->setValue("linkid", $donation->getValue("id"));
        $donationLinksDonation->setValue("paymentid", $paymentId);
        $donationLinksDonation->setValue("amount", $money);
        $donationLinksDonation->create();

        $user = new User();
        $user->load_id($this->dependencyInjector->getDatabase(), $donation->getValue("userid"));
        $user->changeguthaben($this->dependencyInjector->getDatabase(), $money, "Donation von Link " . $donation->getValue("name"));
        $this->createInvoice($user, $money, [["price" => $money, "name" => $this->dependencyInjector->getLang()->getString("addcredit")]]);
        Functions::sendDataToDiscordFeed("Neue Spende","Der Nutzer " . $user->getUsername() . " hat eine Spende über " . $money . "€ erhalten.","https://prohosting24.de/admin/kunden/" . $user->getID());
    }
}
