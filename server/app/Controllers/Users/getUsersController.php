<?php
namespace App\Controllers\Users;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Controllers\Users\_BaseUsersControlled;

class getUsersController extends _BaseUsersController
{
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                'user_info' => $this->usersService->getUsers(),
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}