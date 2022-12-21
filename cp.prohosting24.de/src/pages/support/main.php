<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

switch ($content[1]) {
    case 'ticket':
        $this->sendclient("support/ticket", $router, $config, $content, $user, $lang);
        break;

    default:
        # code...
        break;
}
