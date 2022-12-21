<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

switch ($content[1]) {
    case 'list':
        $this->sendclient("vserver/list", $router, $config, $content, $user, $lang);
        return;
        break;
    case 'order':
        if(isset($content[2])){
            if($content[2] == "p"){
                $this->sendclient("vserver/order/p", $router, $config, $content, $user, $lang);
                return;
            }
        }
        $this->sendclient("vserver/order", $router, $config, $content, $user, $lang);
        return;
        break;
    case 'details':
        $this->sendclient("vserver/details", $router, $config, $content, $user, $lang);
        return;
        break;

    default:
        # code...
        break;
}
