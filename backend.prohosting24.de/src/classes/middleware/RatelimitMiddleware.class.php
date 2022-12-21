<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class RatelimitMiddleware
{
    private $container;
    private $limit;
    private $time;
    private $name;

    public function __construct($container, $name, $time, $limit)
    {
        $this->container = $container;
        $this->limit = $limit;
        $this->time = $time;
        $this->name = $name;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $ratelimitManager = new RatelimitManager($this->container->get('dependencyInjector'));
        if($ratelimitManager->check($this->name, $this->limit)){
            return $this->container->get('dependencyInjector')->getNewResponse()->getError($response, 429, $this->container->get('dependencyInjector')->getLang()->getString("ratelimitreached"));
        }
        $response = $handler->handle($request);
        $ratelimitManager->add($this->name,$this->time);
        return $response;
    }
}