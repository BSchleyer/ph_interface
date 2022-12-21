<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();

switch ($content[1]) {
    case 'lostdomains':
        $this->sendclient("lostdomains", $router, $config, $content, $user);
        return;
        break;

    default:
        # code...
        break;
}
