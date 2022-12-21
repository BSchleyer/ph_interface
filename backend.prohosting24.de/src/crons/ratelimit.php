<?php


$currenttime = date('Y-m-d H:i:s', time());
$serviceinfos = $masterdatabase->delete("main_ratelimit", [
    "expire[<]" => $currenttime,
]);
