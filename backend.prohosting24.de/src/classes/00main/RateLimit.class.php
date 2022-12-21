<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class RateLimit
{
    private $masterdatabase;

    public function __construct($masterdatabase)
    {
        $this->masterdatabase = $masterdatabase;
    }

    public function add($action, $userid, $ip, $max, $delete)
    {
        if ($userid != null) {
            $result = $this->masterdatabase->select("main_ratelimit", [
                "count",
                "maxcount",
            ], [
                "userid[=]" => $userid,
                "action[=]" => $action,
            ]);
            if (count($result) == 0) {
                $this->masterdatabase->insert("main_ratelimit", [
                    "maxcount" => $max,
                    "userid" => $userid,
                    "action" => $action,
                    "expire" => date('Y-m-d H:i', strtotime('+' . $delete, time())),
                ]);
            } else {
                $this->masterdatabase->update("main_ratelimit", [
                    "count" => $result[0]["count"] + 1,
                ], [
                    "userid[=]" => $userid,
                    "action[=]" => $action,
                ]);
            }
        } elseif ($ip != null) {
            $result = $this->masterdatabase->select("main_ratelimit", [
                "count",
                "maxcount",
            ], [
                "ip[=]" => $ip,
                "action[=]" => $action,
            ]);
            if (count($result) == 0) {
                $this->masterdatabase->insert("main_ratelimit", [
                    "maxcount" => $max,
                    "ip" => $ip,
                    "action" => $action,
                    "expire" => date('Y-m-d H:i', strtotime('+' . $delete, time())),
                ]);
            } else {
                $this->masterdatabase->update("main_ratelimit", [
                    "count" => $result[0]["count"] + 1,
                ], [
                    "ip[=]" => $ip,
                    "action[=]" => $action,
                ]);
            }
        }

    }

    public function check($action, $userid, $ip)
    {
        if ($userid != null) {
            $result = $this->masterdatabase->select("main_ratelimit", [
                "count",
                "maxcount",
            ], [
                "userid[=]" => $userid,
                "action[=]" => $action,
            ]);
            if (count($result) == 0) {
                return false;
            } else {
                if ($result[0]["count"] >= $result[0]["maxcount"]) {
                    return true;
                }
                return false;
            }
        } elseif ($ip != null) {
            $result = $this->masterdatabase->select("main_ratelimit", [
                "count",
                "maxcount",
            ], [
                "ip[=]" => $ip,
                "action[=]" => $action,
            ]);
            if (count($result) == 0) {
                return false;
            } else {
                if ($result[0]["count"] >= $result[0]["maxcount"]) {
                    return true;
                }
                return false;
            }
        }
    }
}
