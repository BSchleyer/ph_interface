<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');

$user->logout($config);

header('Location: ' . $url);
