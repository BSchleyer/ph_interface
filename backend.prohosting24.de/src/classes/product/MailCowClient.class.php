<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class MailCowClient
{
    private $mailcowKey = "";
    private $endpoint = "";

    public function __construct($mailcowKey, $endpoint)
	{
        $this->mailcowKey = $mailcowKey;
        $this->endpoint = $endpoint;
    }
    
    public function request($request, $endpoint, $data = [])
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->endpoint."/".$request."/".$endpoint,
            CURLOPT_USERAGENT => 'ProHosting24 Intern',
        ]);
        if(in_array($request,["add","delete","edit"])){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            curl_setopt($curl,CURLOPT_POST,0);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'X-API-Key: ' . $this->mailcowKey,
            'Content-Type: application/json'
        ]);
        $result = curl_exec($curl);
        
        return json_decode($result, true);
    }

    public function createDomain($domain, $description, $quota)
    {
        return $this->request("add","domain",[
            "active" => "1",
            "aliases" => "400",
            "backupmx" => "0",
            "defquota" => "128",
            "description" => $description,
            "domain" => $domain,
            "lang" => "cs",
            "restart_sogo" => "1",
            "mailboxes" => "10",
            "maxquota" => "1024",
            "quota" => $quota,
            "relay_all_recipients" => "0",
            "rl_frame" => "s",
            "rl_value" => "10"
        ]);
    }

    public function getDomain($domain)
    {
        return $this->request("get","domain/" . $domain);
    }

    public function deleteDomain($domain)
    {
        return $this->request("delete","domain",[$domain]);
    }

    public function createMailbox($domain, $name, $password, $fullname)
    {
        return $this->request("add","mailbox",[
            "active" => "1",
            "domain" => $domain,
            "local_part" => $name,
            "name" => $fullname,
            "password" => $password,
            "password2" => $password,
            "quota" => "0",
            "force_pw_update" => "0",
            "tls_enforce_in" => "1",
            "tls_enforce_out" => "1"
        ]);
    }

    public function createDKMI($domain)
    {
        return $this->request("add","dkim",[
            "dkim_selector" => "dkim",
            "domains" => $domain,
            "key_size" => "2048"
        ]);
    }

    public function getDKIM($domain)
    {
        return $this->request("get","dkim/" . $domain);
    }

    public function getMailbox($domain, $name)
    {
        return $this->request("get","mailbox/" . $name . "@" . $domain);
    }

    public function getMailBoxTLD($domain)
    {
        $mailBox = $this->getMailBoxAll();
        $return = [];
        foreach ($mailBox as $box) {
            if($box["domain"] == $domain){
                $return[] = $box;
            }
        }
        return $return;
    }

    public function getMailBoxAll()
    {
        return $this->request("get","mailbox/all");
    }

    public function deleteMailBox($domain)
    {
        return $this->request("delete","mailbox",[$domain]);
    }

    public function editMailBox($domain, $username, $password)
    {
        return $this->request("edit","mailbox",[
            "attr" => [
                "password" => $password,
                "password2" => $password
            ],
            "items" => [$username . "@" . $domain]
        ]);
    }

}