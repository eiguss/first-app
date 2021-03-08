<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

use App\Services\UserService as User;

class AuthMiddleware
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Middleware api
     *
     * @param  $request  PSR7 request
     * @param  $response PSR7 response
     * @param  callable  $next Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function apiMiddleware(Request $request, RequestHandler $handler)
    {
        if(!$this->user->getId() && $request->getMethod() !== 'OPTIONS'){
            $response = new Response();
            return $response->withStatus(401);
        }
        
        $response = $handler->handle($request);

        return $response;
    }
}