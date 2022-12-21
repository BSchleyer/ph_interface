<?php


class CreditLimitController extends RouteTarget
{
    public function getOpenPositions()
    {
        Functions::checkArray(["userid"],$_POST);

        $creditLog = new CreditLog($this->dependencyInjector, null);
        $creditLogs = $creditLog->getAll(["userid" => $_POST["userid"], "paid" => 0], true);

        $this->dependencyInjector->getResponse()->setresponse($creditLogs);
    }

}