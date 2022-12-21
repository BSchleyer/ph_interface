<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();

switch ($content[1]) {
    case 'tickets':
        $this->sendclient("support/tickets", $router, $config, $content, $user);
        return;
        break;
    case 'ticket':
        if ($content[2] == "new") {
            $this->sendclient("support/ticket/new", $router, $config, $content, $user);
            return;
        } else {
            $this->sendclient("support/ticket/details", $router, $config, $content, $user);
        }
        break;

    default:
        # code...
        break;
}
