<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class CacheMiddleware
{
    private $container;
    private $cacheTimer;

    public function __construct($container, $cacheTimer) {
        $this->container = $container;
        $this->cacheTimer = $cacheTimer;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $cacheManager = new CacheManager($this->container->get('dependencyInjector'));
        $cacheId = $request->getUri()->getPath();
        $cache = $cacheManager->getCacheEntry($cacheId);
        if(isset($cache) && $this->container->get('dependencyInjector')->getConfig()->getconfigvalue("debug") == 0) {
            return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, json_decode($cache,true));
        }
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();
        if($response->getStatusCode() == 200){
            $cacheManager->setCacheEntry($cacheId,$existingContent,$this->cacheTimer);
        }
        return $response;
    }
}