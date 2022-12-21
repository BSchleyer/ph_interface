<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

class Response
{
	private $responsearray = [];

	public function __construct()
	{
		$this->responsearray["fail"] = false;
		return true;
	}

	public function getresponsearray()
	{
        $this->log();
		return $this->responsearray;
	}

    public function log()
    {
        if(in_array($_SERVER["HTTP_FUNCTION"],["cronVServerQueueCheckTaskStatus","cronVServerQueueStart","cronVServerQueueStop","cronVServerQueueShutdown","cronVServerQueueDelete","cronVServerQueueInstallStep1","cronVServerQueueInstallStep2","cronVServerQueueMigrateServer","cronVServerHourlyCalc","cronVServerApplyConfig","cronVServerBackupCreate","cronVServerBackupDelete","cronVServerBackupRedeploy","cronVServerQueueReset"])){
            return;
        }
        $data = [
            "server" => $_SERVER,
            "post" => $_POST,
            "get" => $_GET,
            "cookie" => $_COOKIE,
            "env" => $_ENV,
            "files" => $_FILES
        ];
        $apiLog = new ApiLogOld(Functions::$dependencyInjector, null);
        $apiLog->setValue("requestTarget", $_SERVER["HTTP_FUNCTION"]);
        $apiLog->setValue("server", $_SERVER["HTTP_HOST"]);
        $apiLog->setValue("method", $_SERVER["REQUEST_METHOD"]);
        $apiLog->setValue("id", Functions::gen_uuid());
        if(isset($data["post"]["password"])){
            unset($data["post"]["password"]);
        }
        $apiLog->setValue("request", json_encode($data));
        $apiLog->setValue("response", json_encode($this->responsearray));
        $apiLog->create("id", false, true);
    }

	public function printResponse()
	{
        $this->log();
        print_r(json_encode($this->responsearray));
	}

	public function fail($status, $message)
	{
		$this->setfail($status, $message);
		$this->printResponse();
		die();
	}

	public function setfail($status, $message)
	{
		$this->responsearray["fail"] = $status;
		$this->responsearray["error"] = $message;
		return true;
	}

	public function setresponse($response, $cached = false)
	{
		$this->responsearray["response"] = $response;
		if($cached){
            header('Cache: 1');
        }
		return true;
	}

	public function setHeader()
	{
		header('Access-Control-Request-Method: *');
		header('Content-Type: application/json');
		header('access-control-allow-headers: key,function,cronaction');
		header("Access-Control-Allow-Origin: *");
	}
}
