<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;


class CorsMiddleware
{
    /**
     * Middleware invokable class
     *
     * @param  $request  PSR7 request
     * @param  $response PSR7 response
     * @param  callable  $next Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function allowSameDomain(Request $request, RequestHandler $handler)
    {
        $response = $handler->handle($request);

        return $response
            ->withHeader('Access-Control-Allow-Origin', "*")
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}