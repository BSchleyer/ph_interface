<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class Webspace
{
    private $masterdatabase;
    private $client;
    private $config;

    public function __construct($masterdatabase, $config)
    {
        $this->masterdatabase = $masterdatabase;
        $this->config = $config;
        $this->client = new \PleskX\Api\Client($config->getconfigvalue("plesk_host"));
        $this->client->setCredentials($config->getconfigvalue("plesk_username"), $config->getconfigvalue("plesk_passwort"));
    }

    public function adduser($userid)
    {
        $user = new User();
        $user->load_id($this->masterdatabase, $userid);
        $pw = random_str(20);
        
        $random = random_str(10);
        $username = $random;
        $loginemail = $random . "plesk@prohosting24.de";
        $respond = $this->client->customer()->create(
            [
                "cname" => $username,
                "pname" => $user->getVorname() . " " . $user->getNachname(),
                "login" => $username,
                "passwd" => $pw,
                "email" => $random . "plesk@prohosting24.de",
            ]
        );
        
        $this->masterdatabase->insert("webspace_user", [
            "userid" => $userid,
            "pleskid" => $respond->id,
            "username" => $username,
            "email" => $loginemail,
            "firstpw" => $pw,
            "guid" => $respond->guid,
        ]);
        return $this->masterdatabase->id();
    }

    public function getuser($userid)
    {
        return $this->masterdatabase->select("webspace_user", [
            "id",
            "pleskid",
            "username",
            "email",
            "firstpw",
            "guid",
            "status",
            "created_on",
        ], [
            "userid" => $userid,
        ]);
    }

    public function getuserbyid($id)
    {
        return $this->masterdatabase->select("webspace_user", [
            "id",
            "pleskid",
            "username",
            "email",
            "firstpw",
            "guid",
            "status",
            "created_on",
        ], [
            "id" => $id,
        ]);
    }

    public function getusers()
    {
        return $this->masterdatabase->select("webspace_user", [
            "id",
            "pleskid",
            "username",
            "email",
            "firstpw",
            "guid",
            "status",
            "created_on",
        ]);
    }

    public function addwebspace($userid, $packageid, $domain)
    {
        $webspaceuserid = $this->adduser($userid);
        
        $packageinfo = $this->getpackage($packageid);
        if (count($packageinfo) != 1) {
            return 0;
        }
        
        $userinfo = $this->getuserbyid($webspaceuserid);
        if (count($userinfo) != 1) {
            return 0;
        }
        $usert = new User();
        $usert->load_id($this->masterdatabase, $userid);
        $respond = $this->client->webspace()->create(
            [
                "name" => $domain,
                "owner-id" => $userinfo[0]["pleskid"],
                "ip_address" => $this->config->getconfigvalue("plesk_ip"),
            ], [
                "ftp_login" => "web-" . $userid . random_str(4, "1234567890"),
                "ftp_password" => random_str(20),
            ],
            "Web-" . $packageinfo[0]["speicher"] . "GB"
        );
        
        $this->masterdatabase->insert("webspace_main", [
            "userid" => $userid,
            "webspaceuserid" => $userinfo[0]["id"],
            "pleskid" => $respond->id,
            "domain" => $domain,
            "package" => $packageid,
            "guid" => $respond->guid,
        ]);
        return $this->masterdatabase->id();
    }

    public function upgradewebspace($webspaceid, $packageid)
    {
        
        $packageinfo = $this->getpackage($packageid);
        if (count($packageinfo) != 1) {
            return false;
        }
        
        $webspaceinfo = $this->getwebspace($webspaceid);
        if (count($webspaceinfo) != 1) {
            return false;
        }
        $respond = $this->client->request('
        <packet version ="1.6.3.0">
            <webspace>
                <switch-subscription>
                    <filter>
                        <id>' . $webspaceinfo[0]["pleskid"] . '</id>
                    </filter>
                <plan-guid>' . $packageinfo[0]["guid"] . '</plan-guid>
                </switch-subscription>
            </webspace>
        </packet>');
        
        $this->masterdatabase->update("webspace_main", [
            "package" => $packageid,
        ], [
            "id" => $webspaceid,
        ]);
        return true;
    }

    public function getsession($userid, $ip, $webspaceid)
    {
        $webspaceinfo = $this->getwebspace($webspaceid);
        $webspaceuserinfo = $this->getuserbyid($webspaceinfo[0]["webspaceuserid"]);
        $respond = $this->client->request('
        <packet version="1.6.9.1">
          <server>
            <create_session>
              <login>' . $webspaceuserinfo[0]["username"] . '</login>
              <data>
                <user_ip>' . base64_encode($ip) . '</user_ip>
                <source_server></source_server>
              </data>
            </create_session>
          </server>
        </packet>');
        return $respond;
    }

    public function getwebspacediskusage($webspaceid)
    {
        
        $webspaceinfo = $this->getwebspace($webspaceid);
        if (count($webspaceinfo) != 1) {
            return false;
        }
        return $this->client->webspace()->getDiskUsage("id", $webspaceinfo[0]["pleskid"]);
    }

    public function deletewebspace($webspaceid)
    {
        
        $webspaceinfo = $this->getwebspace($webspaceid);
        if (count($webspaceinfo) != 1) {
            return false;
        }
        $userinfo = $this->getuserbyid($webspaceinfo[0]["webspaceuserid"]);
        if (count($userinfo) != 1) {
            return 0;
        }
        try {
            $respond = $this->client->request('
            <packet version="1.6.3.0">
            <customer>
               <del>
                  <filter>
                      <id>' . $userinfo[0]["pleskid"] . '</id>
                  </filter>
               </del>
            </customer>
            </packet>');
            
            $this->masterdatabase->update("webspace_user", [
                "status" => 0,
            ], [
                "pleskid" => $userinfo[0]["pleskid"],
            ]);
        } catch (\PleskX\Api\Exception $th) {
            return false;
        }
        return true;
    }

    public function suspendwebspace($webspaceid)
    {
        
        
        return true;
    }

    public function getpackage($packageid)
    {
        return $this->masterdatabase->select("webspace_packages", [
            "id",
            "pleskid",
            "speicher",
            "guid",
            "created_on",
        ], [
            "id" => $packageid,
        ]);
    }

    public function getpackagespeicher($disk)
    {
        return $this->masterdatabase->select("webspace_packages", [
            "id",
            "pleskid",
            "speicher",
            "guid",
            "created_on",
        ], [
            "speicher" => $disk,
        ]);
    }

    public function getpackages()
    {
        return $this->masterdatabase->select("webspace_packages", [
            "id",
            "pleskid",
            "speicher",
            "guid",
            "created_on",
        ]);
    }

    public function getwebspace($webspaceid)
    {
        return $this->masterdatabase->select("webspace_main", [
            "id",
            "userid",
            "webspaceuserid",
            "pleskid",
            "domain",
            "package",
            "guid",
            "created_on",
        ], [
            "id" => $webspaceid,
        ]);
    }

    public function getwebspaceplesk($pleskid)
    {
        return $this->masterdatabase->select("webspace_main", [
            "id",
            "userid",
            "webspaceuserid",
            "pleskid",
            "domain",
            "package",
            "guid",
            "created_on",
        ], [
            "pleskid" => $pleskid,
        ]);
    }

    public function getwebspaces()
    {
        return $this->masterdatabase->select("webspace_main", [
            "id",
            "userid",
            "webspaceuserid",
            "pleskid",
            "domain",
            "package",
            "guid",
            "created_on",
        ]);
    }

    public function getclient()
    {
        return $this->client;
    }

    public function getallserviceplans()
    {
        return $this->client->ServicePlan()->getAll();
    }

    public function getallwespaces()
    {
        return $this->client->webspace()->getAll();
    }

    public function getDomains($webspaceid)
    {
        $webspaceinfo = $this->getwebspace($webspaceid);
        $userinfo = $this->getuserbyid($webspaceinfo[0]["webspaceuserid"]);

        return $this->client->request('<packet>
          <customer>
            <get-domain-list>
              <filter>
                <id>' . $userinfo[0]["pleskid"] . '</id>
              </filter>
            </get-domain-list>
          </customer>
        </packet>');
    }

}
