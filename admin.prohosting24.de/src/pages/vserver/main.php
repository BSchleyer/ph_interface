<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();

switch ($content[1]) {
    case 'nodes':
        $this->sendclient("nodes", $router, $config, $content, $user);
        return;
        break;

    case 'images':
        $this->sendclient("images", $router, $config, $content, $user);
        return;
        break;

    case 'ips':
        $this->sendclient("ips", $router, $config, $content, $user);
        return;
        break;

    case 'packets':
        $this->sendclient("packets", $router, $config, $content, $user);
        return;
        break;

    case 'lostvms':
        $this->sendclient("lostvms", $router, $config, $content, $user);
        return;
        break;

    default:
        # code...
        break;
}
