<?php
namespace App\Controllers\LoggedUser;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Controllers\LoggedUser\_BaseLoggedUserController;

class getUserInfoController extends _BaseLoggedUserController
{
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                'user_info' => $this->loggedUserService->getUserInfo(),
                'token' => $this->csrfTokenManager->generateCsrfToken(), // This is called on load a page, generating a new CSRF token
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}