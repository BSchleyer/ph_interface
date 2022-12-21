<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

switch ($content[1]) {
    case 'details':
        $this->sendclient("webspace/details", $router, $config, $content, $user, $lang);
        return;
    case 'order':
        $this->sendclient("webspace/order", $router, $config, $content, $user, $lang);
        return;
        break;
    default:
        $this->sendclient("404", $router, $config, $content, $user, $lang);
        return;
}
