<?php


class SevDeskApiClient extends Base
{
    private $sevDeskApiKey = "";
    private $sevDeskApiUrl = "";

    public function __construct($dependencyInjector)
    {
        parent::__construct($dependencyInjector);
        $this->sevDeskApiKey = $this->dependencyInjector->getConfig()->getconfigvalue("sevDeskApiKey");
        $this->sevDeskApiUrl = $this->dependencyInjector->getConfig()->getconfigvalue("sevDeskApiUrl");
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

    public function createUser(UserNew $user)
    {
        if($user->getValue("sevdeskid") == "sevdeskid"){
            $addsduser = $this->sevDeskClient()->post($this->sevDeskApiUrl.'/Contact?token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'customerNumber' => $user->getValue("id"),
                    'parent' => null,
                    'familyname' => $user->getValue("username"),
                    'category' => [
                        'id' => 3,
                        'objectName' => 'Category'
                    ],
                    'description' => null
                ],
            ]);

            $userInfo = json_decode($addsduser->getBody()->getContents(), true);
            $sevDeskId = $userInfo["objects"]["id"];
            $this->sevDeskClient()->post($this->sevDeskApiUrl.'/Contact/addEmail?token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'id' => $sevDeskId,
                    'key' => 8,
                    'value' => $user->getValue("email")
                ],
            ]);
            $user->setValue("sevdeskid", $sevDeskId);
            $user->update();
        }
    }

    public function getInvoiceList(UserNew $user)
    {
        $userId = $user->getValue("sevdeskid");

        if($userId == "sevdeskid"){
            return [];
        }

        $data = $this->sevDeskClient()->get($this->sevDeskApiUrl.'/Invoice?token='.$this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                'contact[id]' => $userId,
                'contact[objectName]' => "Contact"
            ],
        ]);

        return json_decode($data->getBody()->getContents(), true);
    }

    public function getInvoice($invoiceId)
    {
        $data = $this->sevDeskClient()->get($this->sevDeskApiUrl.'/Invoice/' . $invoiceId . '?token='.$this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [],
        ]);
        return json_decode($data->getBody()->getContents(), true);
    }

    public function getInvoicePDF($invoiceId)
    {
        $data = $this->sevDeskClient()->get($this->sevDeskApiUrl.'/Invoice/' . $invoiceId . '/getPdf?token='.$this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [],
        ]);
        return json_decode($data->getBody()->getContents(), true);
    }

    public function payInvoice($invoice, $amount)
    {
        $this->sevDeskClient()->put($this->sevDeskApiUrl . '/Invoice/' . $invoice . '/bookAmmount?token=' . $this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                'ammount' => $amount,
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

    public function deleteInvoice($invoice)
    {
        $this->sevDeskClient()->delete($this->sevDeskApiUrl . '/Invoice/' . $invoice . '/delete?token=' . $this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [],
        ])->getBody();
    }

    public function changeStatusInvoice($invoice, $status)
    {
        $this->sevDeskClient()->put($this->sevDeskApiUrl . '/Invoice/' . $invoice . '?token=' . $this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                'status' => $status
            ],
        ])->getBody();
    }

    public function updateContact($contact, $firstName, $lastName, $street, $houseNumber, $plz, $city, $country, $company)
    {
        if($firstName != "_NULL_"){
            $this->sevDeskClient()->put($this->sevDeskApiUrl . '/Contact/' . $contact . '?token=' . $this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'surename' => $firstName,
                    'familyname' => $lastName
                ],
            ])->getBody();
        }
        $name = $firstName . " " . $lastName;
        if($company != ""){
            $name = $company;
        }

        $result = $this->sevDeskClient()->get($this->sevDeskApiUrl.'/ContactAddress?contact[id]=' . $contact . '&contact[objectName]=Contact&token='.$this->sevDeskApiKey, [
            \GuzzleHttp\RequestOptions::FORM_PARAMS => [],
        ])->getBody()->getContents();
        $result = json_decode($result, true);

        if(count($result["objects"]) == 0){
            $this->sevDeskClient()->post($this->sevDeskApiUrl.'/ContactAddress?token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'contact' => [
                        "id" => $contact,
                        "objectName" => "Contact"
                    ],
                    'country' => [
                        "id" => $country,
                        "objectName" => "StaticCountry"
                    ],
                    'street' => $street . " " . $houseNumber,
                    'zip' => $plz,
                    'city' => $city,
                    'name' => $name,
                ],
            ])->getBody()->getContents();
        } else {
            $this->sevDeskClient()->put($this->sevDeskApiUrl.'/ContactAddress/' . $result["objects"][0]["id"] . '?token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'contact' => [
                        "id" => $contact,
                        "objectName" => "Contact"
                    ],
                    'country' => [
                        "id" => $country,
                        "objectName" => "StaticCountry"
                    ],
                    'street' => $street . " " . $houseNumber,
                    'zip' => $plz,
                    'city' => $city,
                    'name' => $name,
                ],
            ])->getBody()->getContents();
        }
    }

    public function getContactById($id)
    {
        try {
            $data = $this->sevDeskClient()->get($this->sevDeskApiUrl.'/Contact/' . $id . '?token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [],
            ]);
        } catch (Exception $th) {
            return 0;
        }
        return json_decode($data->getBody()->getContents(), true);
    }
    public function getCountrys()
    {
        $data = $this->sevDeskClient()->get($this->sevDeskApiUrl.'/StaticCountry?limit=999&token='.$this->sevDeskApiKey, [
                \GuzzleHttp\RequestOptions::FORM_PARAMS => [],
        ]);
        return json_decode($data->getBody()->getContents(), true)["objects"];
    }
}
