<?php


class RouteTarget
{
    protected DependencyInjector $dependencyInjector;

    public function __construct($dependencyInjector)
    {
        $this->dependencyInjector = $dependencyInjector;
    }
}
