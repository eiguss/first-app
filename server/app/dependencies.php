<?php
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Routing\RouteParser;

use App\Classes\SessionManager;
use App\Classes\CsrfTokenManager;

$container->set(SessionManager::class, function() {
    return new SessionManager();
});

$container->set(CsrfTokenManager::class, function($container) {
    return new CsrfTokenManager($container->get(SessionManager::class));
});