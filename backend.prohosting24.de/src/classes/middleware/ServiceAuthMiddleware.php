<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class ServiceAuthMiddleware
{
    private $container;
    private $productId;

    public function __construct($container, $productId) {
        $this->container = $container;
        $this->productId = $productId;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $args = RouteContext::fromRequest($request)->getRoute()->getArguments();
        $authManager = new AuthManager($this->container->get('dependencyInjector'));
        $authInfo = $authManager->checkAuthServiceId($this->productId, $args["id"], $response);
        if(is_a($authInfo,"Slim\Psr7\Response")){
            return $authInfo;
        }
        return $handler->handle($request);
    }
}