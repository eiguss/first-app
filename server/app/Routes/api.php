<?
use Slim\Routing\RouteCollectorProxy;
use App\Middlewares\CorsMiddleware;
use App\Middlewares\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Controllers\UserController;

$app->group('/api', function (RouteCollectorProxy $app) {
    $app->group('/user', function (RouteCollectorProxy $app) {
        $app->get('', UserController::class.":getUserInfo")
            ->add(AuthMiddleware::class.':apiMiddleware');
        $app->get('/is-logged', UserController::class.":isLogged");
        $app->post('/login', UserController::class.":login");
        $app->post('/logout', UserController::class.":logout");
    }); 
});