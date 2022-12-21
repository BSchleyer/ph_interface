<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();
$currenttime = date('Y-m-d H:i:s', time());
$masterdatabase->delete("main_user_sessions", [
    "valid_until[<]" => $currenttime,
]);
