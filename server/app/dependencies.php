<?php

use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Routing\RouteParser;

use App\Classes\SessionManager;

$container->set(SessionManager::class, function() {
    return new SessionManager();
});