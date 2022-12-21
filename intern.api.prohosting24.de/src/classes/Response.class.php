<?php

defined('RZGvsletoIujWnzKrNyB') or die();

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
        return $this->responsearray;
    }
    public function setfail($status, $nachricht)
    {
        $this->responsearray["fail"] = $status;
        $this->responsearray["error"] = $nachricht;
        return true;
    }
    public function setresponse($response)
    {
        $this->responsearray["response"] = $response;
        return true;
    }
}
