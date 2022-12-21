<?php


switch ($content[1]) {
    case 'security.txt':
        $this->sendclient("security.txt", $router, $config, $content, $user, $lang);#
        return;

    default:
        $router->sendclient("404", $router, $config, $content, $user, $lang);
        die();
}
