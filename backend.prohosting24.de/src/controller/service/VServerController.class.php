<?php


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ph24\service;
use Ph24\service\VServer;

class VServerController extends BaseController
{
    public function info(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $vServer = new VServer($this->dedependencyInjector, $args["id"], "childid");
        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }
        $serviceInfo = $vServer->getServiceInfo();
        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, $serviceInfo);
    }

    public function start(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $vServer = new VServer($this->dedependencyInjector, $args["id"], "childid");

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        $queueEntry = $vServer->start();

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, $queueEntry);
    }

    public function stop(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $vServer = new VServer($this->dedependencyInjector, $args["id"], "childid");

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        $queueEntry = $vServer->stop();

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, $queueEntry);
    }

    public function shutdown(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $vServer = new VServer($this->dedependencyInjector, $args["id"], "childid");

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        $queueEntry = $vServer->shutdown();

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, $queueEntry);
    }

    public function reset(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $vServer = new VServer($this->dedependencyInjector, $args["id"], "childid");

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        $queueEntry = $vServer->reset();

        if($this->dedependencyInjector->isFail()){
            return $this->dedependencyInjector->getNewResponse()->getError($response, $this->dedependencyInjector->getResponseCode(),$this->dedependencyInjector->getMessage());
        }

        return $this->container->get('dependencyInjector')->getNewResponse()->getResponse($response, 200, $queueEntry);
    }
}