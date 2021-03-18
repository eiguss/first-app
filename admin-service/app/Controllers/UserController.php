<?php
namespace Service\Admin\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Service\Admin\Storages\UserStorage;

class UserController extends Controller 
{
    private $userStorage;
    
    public function __construct(UserStorage $userStorage)
    {
        $this->userStorage = $userStorage;
    }

    public function getUser(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                "data" => $this->userStorage->getUser()
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}