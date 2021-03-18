<?php
use Slim\Factory\AppFactory;
use Service\Admin\Exceptions\Handler;

require __DIR__ . '/vendor/autoload.php';

//Create container
$container = new DI\Container();
// Create slim application
AppFactory::setContainer($container);
$app = AppFactory::create();

// Routes
require __DIR__.'/app/routes.php';


// Add Routing Middleware
$app->addRoutingMiddleware();

// Add error handler
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(new Handler());

// Run the app
$app->run();