<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

use App\Services\loggedUserService as User;

class RightsMiddleware
{
    private $user;

    private $routesRight = [
        'getUsers' => 'users_management',
    ];

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Middleware api
     *
     * @param  $request  PSR7 request
     * @param  callable  $handler handler middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $routeName = RouteContext::fromRequest($request)->getRoute()->getName();
        if(!in_array($this->routesRight[$routeName], $this->user->getRights())){
            $response = new Response();
            return $response->withStatus(403);
        }

        $response = $handler->handle($request);

        return $response;
    }
}