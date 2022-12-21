<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["tablename", "rowname", "value", "log", "userid", "ip"])) {
    $response->setfail(true, checkpost2($_POST, ["tablename", "rowname", "value", "log", "userid", "ip"]));
    return;
}
logit($masterdatabase, $_POST["tablename"], $_POST["rowname"], $_POST["value"], $_POST["log"], $_POST["userid"], $_POST["ip"]);
