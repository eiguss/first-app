<?
use Slim\Routing\RouteCollectorProxy;
use App\Middlewares\CorsMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/api', function (RouteCollectorProxy $app) {
    $app->get('/[{path:.*}]', function (Request $request, Response $response, $args) {
        //throw new \Exception('Api routes not defined.');
        sleep(2);
        $response->getBody()->write('ey');
        
        return $response;
    });
})->add(CorsMiddleware::class.':allowSameDomain');