<?php


defined('m6zGtn2B5a6ErJbbIvvS') or die();
if (!isset($content[1])) {
    $this->sendclient("404", $router, $config, $content, $user, $lang);
}
switch ($content[1]) {
    case 'list':
        $this->sendclient("invoice/list", $router, $config, $content, $user, $lang);
        return;
        break;

    case 'details':
        $this->sendclient("invoice/details", $router, $config, $content, $user, $lang);
        return;
        break;

    default:
        $this->sendclient("404", $router, $config, $content, $user, $lang);
        return;
        break;
}
