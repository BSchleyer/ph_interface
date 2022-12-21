<?php



$cron = New VServerCron($dependencyInjector, null);
$crons = $cron->getAll(["status" => 1]);


foreach ($crons as $cronDb){
    $cronExpression = $cronDb->getValue('cron_minute') . " " . $cronDb->getValue('cron_hour') . " " .  $cronDb->getValue('cron_day_of_month') . " " .  $cronDb->getValue('cron_month') . " " .  $cronDb->getValue('cron_day_of_week');
    try {
        $cron = new Cron\CronExpression($cronExpression);

        if($cron->isDue()){
            $cronDb->log("cronstartinfo");
            $vserver = new \Ph24\service\VServer($dependencyInjector, $cronDb->getValue("vserverid"), "childid");

            if($vserver->getValue("delete_at") != "delete_at"){
                $cronDb->log("crondisableinfo");
                $cronDb->setValue("status", 0);
                $cronDb->update();
                continue;

            }

            $queue = new VServerQueue($dependencyInjector, null);
            $queueList = $queue->getAll(["serviceid" => $cronDb->getValue("vserverid"), "status[!]" => 2]);
            if(count($queueList) != 0){
                $cronDb->log("crontaskrunning");
                continue;
            }
            $vserver = new \Ph24\service\VServer($dependencyInjector, $cronDb->getValue("vserverid"), "childid");

            switch ($cronDb->getValue("action")){
                case 'start':
                    $vserver->start();
                    $cronDb->log("cronexecsuccessfullqueue");
                    break;
                case 'stop':
                    $vserver->stop();
                    $cronDb->log("cronexecsuccessfullqueue");
                    break;
                case 'reset':
                    $vserver->reset();
                    $cronDb->log("cronexecsuccessfullqueue");
                    break;
                case 'shutdown':
                    $vserver->shutdown();
                    $cronDb->log("cronexecsuccessfullqueue");
                    break;
                case 'backup':
                    $queue->setValue("serviceid", $cronDb->getValue("vserverid"));
                    $queue->setValue("action", 9);
                    $queue->create();
                    $cronDb->log("cronexecsuccessfullqueue");
                    break;
                case 'fstrim':
                    $image = $vserver->getImage();
                    if($image->getValue('type') == "windows"){
                        $vserver->fsTrim();
                        $cronDb->log("error");
                        break;
                    } else {
                        $cronDb->setValue("command", 'fstrim -va');
                    }
                case 'command':
                    $vserver = new VServer($dependencyInjector);
                    $vserver->loadwithid($cronDb->getValue("vserverid"));

                    $agentData = $vserver->getAgentInfo();

                    if(!isset($agentData["data"]["result"])){
                        $cronDb->log("croncommanderror");
                        continue 2;
                    }

                    $data = $vserver->executecommand($cronDb->getValue("command"));


                    if(!isset($data["data"]["pid"])){
                        $cronDb->log("croncommanderror");
                        continue 2;
                    }

                    $pid = $data["data"]["pid"];

                    $execList = new VserverExecList($dependencyInjector, null);
                    $execList->setValue("vserverid", $cronDb->getValue("vserverid"));
                    $execList->setValue("pid", $pid);
                    $execList->setValue("command", htmlspecialchars($cronDb->getValue("command")));
                    $execList->create();
                    $cronDb->log("cronexecsuccessfull");
                    break;
            }
            $cronDb->setValue('next_run_at', $cron->getNextRunDate()->format('Y-m-d H:i:s'));
            $cronDb->setValue('last_run_at', $cron->getPreviousRunDate()->format('Y-m-d H:i:s'));
            $cronDb->update();
        }
    }catch (Exception $e){
        $cronDb->log("cronexecerroradmin");
        $cronDb->log("crondisableinfo");
        $cronDb->setValue("status", 0);
        $cronDb->update();
        Functions::errorLog("vserverCronError", "Error In Cron", $e);
    }
}