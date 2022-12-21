<?php



$payment = new Payment($config, $dependencyInjector);
$user = new User();
$user->load_id($masterdatabase, 2);

$payment->createInvoice($user, 15);
echo "1";