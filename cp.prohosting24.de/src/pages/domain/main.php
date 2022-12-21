<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

switch ($content[1]) {
    case 'order':
        $this->sendclient("domain/order", $router, $config, $content, $user, $lang);
        return;
    case 'details':
        $this->sendclient("domain/details", $router, $config, $content, $user, $lang);
        return;

    default:
        $this->sendclient("404", $router, $config, $content, $user, $lang);
        return;
}
