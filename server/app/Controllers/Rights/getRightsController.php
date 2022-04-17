<?php
namespace App\Controllers\Rights;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Controllers\Rights\_BaseRightsControlled;

class getRightsController extends _BaseRightsController
{
    public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write(
            json_encode([
                'rights_info' => $this->rightsService->getRights(),
            ])
        );

        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}