<?php
namespace App\Controllers\LoggedUser;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Controllers\LoggedUser\_BaseLoggedUserController;

class loginController extends _BaseLoggedUserController
{
    public function __invoke(Request $request, Response $response)
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
                'user-info' => $this->loggedUserService->login($params['email'], $params['password'])
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}