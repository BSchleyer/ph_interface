<?php


class NewResponse
{
    private $responseArray = [];

    public function fail($status)
    {
        echo json_encode($this->responseArray);
        http_response_code($status);
        header('Content-Type: application/json');
        die();
    }

    public function failPostInit($status, $message)
    {
        $this->responseArray = ["error" => $message];
        $this->fail($status);
    }


    public function failPreInit($status, $message)
    {
        $this->responseArray = ["error" => $message, "preInit" => true];
        $this->fail($status);
    }

    public function getError($response, $status, $message)
    {
        $payload = json_encode(["error" => $message]);
        $response->getBody()->write($payload);
        $response = $response->withStatus($status);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getResponse($response, $status, $data)
    {
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        $response = $response->withStatus($status);
        return $response->withHeader('Content-Type', 'application/json');
    }

}