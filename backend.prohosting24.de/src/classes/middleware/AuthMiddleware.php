<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class AuthMiddleware
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $authManager = new AuthManager($this->container->get('dependencyInjector'));
        if(!$authManager->checkAuth()){
            return $this->container->get('dependencyInjector')->getNewResponse()->getError($response, 401, $this->container->get('dependencyInjector')->getLang()->getString("novalidauth"));
        }
        return $handler->handle($request);
    }
}