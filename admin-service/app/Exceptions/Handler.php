<?
namespace Service\Admin\Exceptions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class Handler
{
    public function __invoke(
        Request $request,
        \Throwable $e,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        ?LoggerInterface $logger = null
    )
    {
        $payload = ['error' => $e->getMessage()];

        $response = new Response();

        $response->getBody()->write(
            json_encode([
                "error" => $e->getMessage()
            ])
        );
        echo "<pre>";var_dump($e);exit();
        return $response->withStatus(500);
    }
}