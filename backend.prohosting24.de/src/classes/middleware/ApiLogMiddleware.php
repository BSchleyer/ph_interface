<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ApiLogMiddleware
{
    private $container;
    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $data = [
            "atributes" => $request->getAttributes(),
            "queryParams" =>$request->getQueryParams(),
            "server" => $_SERVER,
            "post" => $_POST,
            "get" => $_GET,
            "cookie" => $_COOKIE,
            "env" => $_ENV,
            "files" => $_FILES
        ];

        $apiLog = new ApiLog($this->container->get('dependencyInjector'), null);
        $starttime = microtime(true);
        $apiLog->setValue("requestTarget", $request->getRequestTarget());
        $apiLog->setValue("server", $_SERVER["HTTP_HOST"]);
        $apiLog->setValue("method", $request->getMethod());
        $apiLog->setValue("id", Functions::gen_uuid());
        if(isset($data["post"]["password"])){
            unset($data["post"]["password"]);
        }
        $apiLog->setValue("request", json_encode($data));
        $request = $handler->handle($request);

        $endtime = microtime(true);
        $proccessingTime = $endtime - $starttime;

        $data = [
            "starttime" => $starttime,
            "endtime" => $endtime,
            "diff" => $proccessingTime,
            "response" => (string) $request->getBody()
        ];

        header('X-Request-Id: ' . $apiLog->getValue("id"));

        $apiLog->setValue("response", json_encode($data));
        $apiLog->create("id", false, true);

        return $request;
    }
}