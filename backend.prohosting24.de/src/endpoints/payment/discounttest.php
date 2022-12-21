<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$discount = new Discount($masterdatabase, $config);
$discount->loadwithcode("Nicolas-Test");
echo $discount->redeem(1);
