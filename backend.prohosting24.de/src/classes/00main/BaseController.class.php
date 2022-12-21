<?php

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BaseController
{
    protected $container;
    protected DependencyInjector $dedependencyInjector;
    protected DependencyInjector $dependencyInjector;

    public function __construct(ContainerInterface $container)
    {
        $this->dedependencyInjector = $container->get('dependencyInjector');
        $this->dependencyInjector = $this->dedependencyInjector;
        $this->container = $container;
    }
}