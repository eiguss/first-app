<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Services\UserService;
use App\Controllers\Controller;
use App\Classes\CsrfTokenManager;
use App\Validators\ParamsValidator;

class UserController extends Controller 
{

    protected $userService;
    protected $csrfTokenManager;
    
    public function __construct(UserService $userService, CsrfTokenManager $csrfTokenManager, ParamsValidator $paramsValidator)
    {
        $this->userService = $userService;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->paramsValidator = $paramsValidator;
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
        $params = $this->getParamsAndValidate($request, [
            'email'     => ['type' => 'string', 'canBeEmpty' => false],
            'password'  => ['type' => 'string', 'canBeEmpty' => false],
            'token'     => ['type' => 'string', 'canBeEmpty' => false],
        ]);

        if($params['token'] !== $this->csrfTokenManager->getCsrfToken()){
            throw new \Exception('Invalid token', 403);
        }

        $response->getBody()->write(
            json_encode([
                'user-info' => $this->userService->login($params['email'], $params['password'])
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}