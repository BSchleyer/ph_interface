<?php


defined('m6zGtn2B5a6ErJbbIvvS') or die();
if (!isset($content[1])) {
    $this->sendclient("404", $router, $config, $content, $user, $lang);
}
switch ($content[1]) {
    case 'history':
        $this->sendclient("credit/history", $router, $config, $content, $user, $lang);
        return;
        break;

    case 'add':
        $this->sendclient("credit/add", $router, $config, $content, $user, $lang);
        return;
        break;

    case 'limit':
        $this->sendclient("credit/limit", $router, $config, $content, $user, $lang);
        return;
        break;

    default:
        $this->sendclient("404", $router, $config, $content, $user, $lang);
        return;
        break;
}
