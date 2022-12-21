<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();
$url = $config->getconfigvalue('url');

$user->logout($config);

header('Location: ' . $url);
