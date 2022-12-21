<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

$data = $masterdatabase->query("select vm.backuphour, vm.id
from service_main sm 
left join vserver_main vm on vm.id = sm.serviceid 
where sm.produktid = 1
and sm.delete_done = 0
and vm.backuphour is not null
and 0 = (select count(*) from vserver_crons vc where vc.vserverid = sm.serviceid and vc.status = 1);")->fetchAll();

foreach ($data as $vserver) {
    echo $vserver["backuphour"] . " " . $vserver["id"] . "\n";
    $cron = new VServerCron($dependencyInjector, null);
    $cron->setValue('vserverid', $vserver["id"]);
    $cron->setValue('name', 'Backup');
    $cron->setValue('cron_day_of_week', '*');
    $cron->setValue('cron_month', '*');
    $cron->setValue('cron_day_of_month', '*');
    $cron->setValue('cron_hour', $vserver["backuphour"] . '');
    $cron->setValue('cron_minute', '0');
    $cron->setValue('action', 'backup');
    $cron->create();
}