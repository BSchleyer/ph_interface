<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class Ts3
{
    private $masterdatabase;
    private $config;
    private $connection;
    private $maxbackups = 5;

    public function __construct($masterdatabase, $config)
    {
        $this->masterdatabase = $masterdatabase;
        $this->config = $config;
        $string = "serverquery://" . $config->getconfigvalue("ts_username") . ":" . $config->getconfigvalue("ts_password") . "@" . $config->getconfigvalue("ts_ip") . ":" . $config->getconfigvalue("ts_port") . "/?nickname=ProHosting24-" . random_str(7, "1234567890");
        $ts3init = new TeamSpeak3();
        $this->connection = $ts3init->factory($string);
        $this->maxbackups = $config->getconfigvalue("ts_maxbackups");
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function create($userid, $slots)
    {
        $usert = new User();
        $usert->load_id($this->masterdatabase, $userid);
        $serverinfos = $this->connection->serverCreate(array(
            "virtualserver_name" => "Teamspeak 3 Server - Prohosting24",
            "virtualserver_maxclients" => $slots,
        ));
        
        $this->masterdatabase->insert("ts3_main", [
            "userid" => $userid,
            "ts3id" => $serverinfos["sid"],
            "slots" => $slots,
            "port" => $serverinfos["virtualserver_port"],
        ]);
        return $serverinfos;
    }

    public function delete($serverid)
    {
        try {
            $this->stop($serverid);
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            
        }
        $this->connection->serverDelete($serverid);
    }

    public function reinstall($serverid)
    {
        $ts3info = $this->getServerByTs3Id($serverid);
        if (count($ts3info) != 1) {
            return false;
        }
        try {
            $this->delete($serverid);
            $serverinfos = $this->connection->serverCreate(array(
                "virtualserver_name" => "Teamspeak 3 Server - Prohosting24",
                "virtualserver_maxclients" => $ts3info[0]["slots"],
            ));
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            return false;
        }
        $this->masterdatabase->update("ts3_main", [
            "ts3id" => $serverinfos["sid"],
            "port" => $serverinfos["virtualserver_port"],
        ], [
            "ts3id" => $serverid,
        ]);
        return $serverinfos;
    }

    public function start($serverid)
    {
        $this->connection->serverStart($serverid);
    }

    public function stop($serverid)
    {
        $this->connection->serverStop($serverid);
    }

    public function getServerByTs3Id($id)
    {
        return $this->masterdatabase->select("ts3_main", [
            "id",
            "userid",
            "ts3id",
            "slots",
            "port",
            "created_on",
        ], [
            "ts3id" => $id,
        ]);
    }

    public function getServerById($id)
    {
        return $this->masterdatabase->select("ts3_main", [
            "id",
            "userid",
            "ts3id",
            "slots",
            "port",
            "created_on",
        ], [
            "id" => $id,
        ]);
    }

    public function edit($serverid, $slots)
    {
        
        $ts3info = $this->getServerByTs3Id($serverid);
        if (count($ts3info) != 1) {
            return false;
        }
        $this->connection->serverGetById($serverid)->modify(array(
            "virtualserver_maxclients" => $slots,
        ));
        $this->masterdatabase->update("ts3_main", [
            "slots" => $slots,
        ], [
            "id" => $ts3info[0]["id"],
        ]);
    }

    public function getServerGroupList($serverid)
    {
        return $this->connection->serverGetById($serverid)->serverGroupList();
    }

    public function getClientList($serverid)
    {
        try {
            return $this->connection->serverGetById($serverid)->clientList();
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            return [];
        }
    }

    public function getClientListDb($serverid)
    {
        try {
            return $this->connection->serverGetById($serverid)->clientListDb();
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            return [];
        }
    }

    public function getClientCount($serverid)
    {
        return $this->connection->serverGetById($serverid)->clientCount();
    }

    public function getUptime($serverid)
    {
        try {
            return $this->connection->serverGetById($serverid)->virtualserver_uptime;
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            return 0;
        }
    }

    public function getClientCountDb($serverid)
    {
        return $this->connection->serverGetById($serverid)->clientCountDb();
    }

    public function getServerGroupById($serverid, $groupid)
    {
        return $this->connection->serverGetById($serverid)->serverGroupGetById($groupid);
    }

    public function getTokenList($serverid)
    {
        try {
            return $this->connection->serverGetById($serverid)->tokenList();
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            
            return false;
        }
    }

    public function deletetoken($serverid, $token)
    {
        try {
            return $this->connection->serverGetById($serverid)->privilegeKeyDelete($token);
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            
            return false;
        }
    }

    public function createtoken($serverid, $groupname)
    {
        try {
            if (!$this->getConnection()->serverGetById($serverid)->isOnline()) {
                return 3;
            }
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            return 3;
        }
        
        $ts3info = $this->getServerByTs3Id($serverid);
        if (count($ts3info) != 1) {
            return 1;
        }
        try {
            $group = $this->getConnection()->serverGetById($serverid)->serverGroupGetByName($groupname);

            if ($group->getInfo()["type"] != 1) {
                return 4;
            }
            $group->privilegeKeyCreate();
            return 0;
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            return 2;
        }
    }
    public function createBackup($serverid, $produktid)
    {
        try {
            if (!$this->getConnection()->serverGetById($serverid)->isOnline()) {
                return 3;
            }
        } catch (\TeamSpeak3_Adapter_ServerQuery_Exception $th) {
            return 3;
        }
        
        $backupcount = count($this->getBackups($produktid));
        if ($backupcount > $this->maxbackups) {
            return 2;
        }
        
        $ts3info = $this->getServerByTs3Id($serverid);
        if (count($ts3info) != 1) {
            return 1;
        }
        $backup = $this->getBackup($serverid);
        $this->masterdatabase->insert("ts3_backups", [
            "ts3id" => $ts3info[0]["id"],
            "backup" => $backup,
        ]);
        return 0;
    }

    public function deleteBackup($backupid)
    {
        $this->masterdatabase->delete("ts3_backups", [
            "id" => $backupid,
        ]);
    }

    public function getBackups($serverid)
    {
        return $this->masterdatabase->select("ts3_backups", [
            "id",
            "created_on",
        ], [
            "ts3id" => $serverid,
            "ORDER" => ["id" => "ASC"],
        ]);
    }

    public function deployBackupDb($backupid)
    {
        $backupinfo = $this->masterdatabase->select("ts3_backups", [
            "[>]ts3_main" => ["ts3id" => "id"],
        ], [
            "ts3_backups.backup",
            "ts3_main.ts3id",
        ], [
            "ts3_backups.id" => $backupid,
        ]);
        if (count($backupinfo) != 1) {
            return false;
        }
        $this->deployBackup($backupinfo[0]["ts3id"], $backupinfo[0]["backup"]);
    }

    public function getBackup($serverid)
    {
        return $this->connection->serverGetById($serverid)->snapshotCreate(0x01);
    }

    public function deployBackup($serverid, $data)
    {
        return $this->connection->serverGetById($serverid)->snapshotDeploy($data, 0x01);
    }

}
