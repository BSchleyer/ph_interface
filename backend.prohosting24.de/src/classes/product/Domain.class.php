<?php


    public function adddomain($domain, $kontaktid, $ns, $userid, $authcode = "")
    {
        
        if (count(explode(".", $domain)) != 2) {
            return "Domain Name ist nicht Valide";
        }
        $sqlarray = [
            "tld" => $this->getdomainbytld(explode(".", $domain)[1])[0]["id"],
            "sld" => explode(".", $domain)[0],
            "userid" => $userid,
            "kontakt" => $kontaktid,
        ];
        $kontakinfos = $this->getkontaktbyid($kontaktid);
        $apiarray = [
            "domainName" => $domain,
            "ownerC" => $kontakinfos[0]["handle"],
            "adminC" => $kontakinfos[0]["handle"],
            "techC" => $this->config->getconfigvalue("domain_tech_hanlde"),
            "zoneC" => $this->config->getconfigvalue("domain_zone_hanlde"),
            "create_zone" => false,
            "years" => 1
        ];
        $nscount = 1;
        foreach ($ns as $nskey => $nsvalue) {
            $nameserverdata = $this->getnameserverbyid($nsvalue);
            $sqlarray["ns" . $nscount] = $nameserverdata[0]["id"];
            $apiarray["ns" . $nscount] = $nameserverdata[0]["servername"];
            $nscount++;
        }
        
        if ($authcode != "") {
            $apiarray["authinfo"] = $authcode;
        }
        try {
            $res = NicAPI::post("domain/domains/create", $apiarray);
        }catch (Exception $e){
            Functions::errorLog("domainCreation", "Domain Creation Error", $e);
            Functions::errorLog("domainCreation", "Domain Creation Error", $e->getResponse()->getBody()->getContents());
            $data = $e->getResponse()->getBody()->getContents();
            if(isset($data["messages"]["erros"][0]["message"])){
                return $data["messages"]["erros"][0]["message"];
            } else  {
                return "Error";
            }
        }
        
        $this->masterdatabase->insert("domain_main", $sqlarray);
        return "";
    }
    public function getdomainbyid($id)
    {
        $domaininfo = $this->masterdatabase->select("domain_main", [
            "id",
            "tld",
            "sld",
            "userid",
            "kontakt",
            "ns1",
            "ns2",
            "ns3",
            "ns4",
            "ns5",
            "created_on",
        ], [
            "id" => $id,
        ]);
        $domaininfo = $domaininfo[0];
        $domaininfo["api"] = $this->getdomaininfofromapi($domaininfo["sld"] . "." . $this->getdomaintldbyid($domaininfo["tld"])[0]["tld"])["data"]["domain"];
        return $domaininfo;
    }

    public function getdomainbydomain($domain, $api = true)
    {
        $domaininfo = $this->masterdatabase->select("domain_main", [
            "[>]domain_list" => ["tld" => "id"],
        ], [
            "domain_main.id",
            "domain_main.sld",
            "domain_main.userid",
            "domain_main.kontakt",
            "domain_main.ns1",
            "domain_main.ns2",
            "domain_main.ns3",
            "domain_main.ns4",
            "domain_main.ns5",
            "domain_main.created_on",
            "domain_list.tld",
        ], [
            "domain_list.tld" => explode(".", $domain)[1],
            "domain_main.sld" => explode(".", $domain)[0],
        ]);
        if(count($domaininfo) == 0){
            return 404;
        }
        $domaininfo = $domaininfo[count($domaininfo) - 1];
        if($api){
            $domaininfo["api"] = $this->getdomaininfofromapi($domain)["data"]["domain"];
        }
        return $domaininfo;
    }

    public function getdomaininfofromapi($name)
    {
        return NicAPI::get("domain/domains/show", [
            "domainName" => $name,
        ]);
    }

    public function gatalldomainsfromapi()
    {
        return NicAPI::get("domain/domains", [
        ]);
    }

    public function editdomain($domainid, $domain, $kontaktid, $ns)
    {
        $sqlarray = [
            "kontakt" => $kontaktid,
        ];
        $kontakinfos = $this->getkontaktbyid($kontaktid);
        $apiarray = [
            "domainName" => $domain,
            "ownerC" => $kontakinfos[0]["handle"],
            "adminC" => $kontakinfos[0]["handle"],
            "techC" => $this->config->getconfigvalue("domain_tech_hanlde"),
            "zoneC" => $this->config->getconfigvalue("domain_zone_hanlde"),
        ];
        $nscount = 1;
        foreach ($ns as $nskey => $nsvalue) {
            if ($nsvalue == -1) {
                $sqlarray["ns" . $nscount] = null;
                $apiarray["ns" . $nscount] = "";
            } else {
                $nameserverdata = $this->getnameserverbyid($nsvalue);
                $sqlarray["ns" . $nscount] = $nameserverdata[0]["id"];
                $apiarray["ns" . $nscount] = $nameserverdata[0]["servername"];
            }
            $nscount++;
        }
        
        $this->masterdatabase->update("domain_main", $sqlarray,
            [
                "id" => $domainid,
            ]);
        $res = "";
        try {
            $res = NicAPI::post("domain/domains/edit", $apiarray);
        }catch (\GuzzleHttp\Exception\ClientException $e) {
            Functions::errorLog("domainEditError", "Domain edit Error", $e);
        }
        return $res;
    }

    public function deletedomain($domain, $date)
    {
        $res = "";
        try {
            $res = NicAPI::delete("domain/domains/delete", [
                "domainName" => $domain,
                "date" => $date,
            ]);
            Functions::errorLog("domainDelete", "Domain Delete", $res);
        }catch (\GuzzleHttp\Exception\ClientException $e) {
            Functions::errorLog("domainDeleteError", "Domain delete Error", $e);
        }
        return $res;
    }

    public function restoredomain($domain)
    {
        
        
        $res = NicAPI::post("domain/domains/restore", [
            "domainName" => $domain,
        ]);
        return $res;
    }

    public function undodeletedomain($domain)
    {
        $res = "";
        try {
            $res = NicAPI::post("domain/domains/undelete", [
                "domainName" => $domain,
            ]);
            Functions::errorLog("domainUndelete", "Domain undelete", $res);
        }catch (\GuzzleHttp\Exception\ClientException $e) {
            Functions::errorLog("domainUndeleteError", "Domain undelete Error", $e);
        }
        return $res;
    }

    public function checkdomain($domain)
    {
        
        
        $res = NicAPI::post("domain/domains/check", [
            "domainName" => $domain,
        ]);
        return $res["data"]["available"];
    }

}
