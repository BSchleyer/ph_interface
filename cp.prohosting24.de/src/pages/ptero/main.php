<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

switch ($content[1]) {
    case 'order':
        $this->sendclient("app/order", $router, $config, $content, $user, $lang);
        return;
        break;
    case 'details':
        $this->sendclient("app/details", $router, $config, $content, $user, $lang);
        return;
        break;

    default:
        # code...
        break;
}
