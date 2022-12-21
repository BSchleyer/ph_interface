<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class ExternLink
{
    private $masterdatabase;
    private $config;

    public function __construct($masterdatabase, $config)
    {
        $this->masterdatabase = $masterdatabase;
        $this->config = $config;
    }

    public function addlink($userid, $action)
    {
        $link = random_str(64);
        $this->masterdatabase->insert("main_link", [
            "userid" => $userid,
            "action" => $action,
            "link" => $link,
        ]);
        return $this->config->getconfigvalue("frontend_url") . '/link/' . $link;
    }

    public function getlinkinfo($link)
    {
        return $this->masterdatabase->select("main_link", [
            "userid",
            "action",
            "link",
            "done",
        ], [
            "link" => $link,
        ]);
    }

    public function resolvelink($link, $data)
    {
        $linkinfo = $this->masterdatabase->select("main_link", [
            "id",
            "userid",
            "action",
        ], [
            "link" => $link,
            "done" => 0,
        ]);
        if (count($linkinfo) != 1) {
            return "Dieser Link existiert nicht.";
        }
        switch ($linkinfo[0]["action"]) {
            case 'passwordforgot':
                if ($data["passwort"] == "") {
                    return "Das Passwort darf nicht leer sein!";
                }
                if ($data["passwort"] == " ") {
                    return "Das Passwort darf nicht leer sein!";
                }
                $this->masterdatabase->update("main_user", [
                    "password" => password_hash($data["passwort"], PASSWORD_ARGON2I),
                ], [
                    "id" => $linkinfo[0]["userid"],
                ]);
                $user = new User();
                $user->load_id($this->masterdatabase, $linkinfo[0]["userid"]);
                $mail = new Mail($this->masterdatabase, $this->config);
                $mail->addmail("main_passwortchanged", $user->getID(), ["name" => $user->getVorname() . " " . $user->getNachname()]);
                
                $this->masterdatabase->update("main_link", [
                    "done" => 1,
                ], [
                    "link" => $link,
                ]);
                
                $user->deletesessions($this->masterdatabase);
                break;

            default:
                return "Diese Aktion existiert nicht.";
                break;
        }
        return "";

    }

}
