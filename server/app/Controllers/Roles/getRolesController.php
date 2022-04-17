<?php
namespace App\Controllers\Roles;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Controllers\Roles\_BaseRolesControlled;

class getRolesController extends _BaseRolesController
{
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                'roles_info' => $this->rolesService->getRoles(),
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}