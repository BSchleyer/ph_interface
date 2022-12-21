<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');

requestBackend($config, ["userid" => $user->getId()], "newsletterUnsubscribe", $user->getLang());
setcookie('ph24_notify_success', $lang->getString("successfulunsubscribe"), time()+3600, '/');
header('Location: ' . $url);
die();