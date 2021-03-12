<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Services\UserService;
use App\Controllers\Controller;

class UserController extends Controller 
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

    public function login(Request $request, Response $response, array $arguments = [])
    {
        $email = $this->getParam($request, 'email', null);
        $password = $this->getParam($request, 'password', null);

        if(empty($email)||empty($password)||!is_string($email)||!is_string($password)){
            throw new \Exception('Invalid parameters', 422);
        }

        $response->getBody()->write(
            json_encode([
                "user-info" => $this->userService->login($email,$password)
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}