<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Services\UserService;

class UserController
{

    protected $userService;
    protected $jsonResponse;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUserInfo(Request $request, Response $response, array $arguments = [])
    {
        $response->getBody()->write(
            json_encode([
                "user-info" => $this->userService->getUserInfo()
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}