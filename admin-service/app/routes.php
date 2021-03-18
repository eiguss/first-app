<?
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Service\Admin\Controllers\UserController;


$app->group('/user', function (RouteCollectorProxy $app) {
    $app->get('', UserController::class.":getUser");
});

$app->get('/[{path:.*}]', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello word");

    return $response;
});
