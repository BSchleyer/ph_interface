<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');

$user->logout($config);

header('Location: ' . $url);
