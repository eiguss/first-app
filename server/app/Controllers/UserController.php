<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Services\UserService;
use App\Controllers\Controller;
use App\Classes\CsrfTokenManager;

class UserController extends Controller 
{

    protected $userService;
    protected $jsonResponse;
    protected $csrfTokenManager;
    
    public function __construct(UserService $userService, CsrfTokenManager $csrfTokenManager)
    {
        $this->userService = $userService;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function getUserInfo(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                'user_info' => array_merge(
                    $this->userService->getUserInfo(),
                    [
                        // This is called on load a page, generating a new CSRF token
                        'token' => $this->csrfTokenManager->generateCsrfToken()
                    ]
                )
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
    

    public function isLogged(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                'isLogged' => $this->userService->isLogged(),
                // generate csrf token for login
                'token' => $this->csrfTokenManager->generateCsrfToken()
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
    

    public function logout(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                'logout' => $this->userService->logout()
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }

    public function login(Request $request, Response $response)
    {
        // TODO validate parems
        $email = $this->getParam($request, 'email', null);
        $password = $this->getParam($request, 'password', null);
        $token = $this->getParam($request, 'token', null);
        if($token !== $this->csrfTokenManager->getCsrfToken()){
            throw new \Exception('Invalid token', 403);
        }

        if(empty($email)||empty($password)||!is_string($email)||!is_string($password)){
            throw new \Exception('Invalid parameters', 422);
        }

        $response->getBody()->write(
            json_encode([
                'user-info' => $this->userService->login($email,$password)
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}