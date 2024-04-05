<?php 
namespace App\Presentation\Middlewares;

use Throwable;
use Slim\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorMiddleware implements MiddlewareInterface
{
    public function __construct(private ContainerInterface $container) {}

    /**
     * Middleware de erro
     * Envolve toda a requisição em um tratamento de erros
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            $message = $e->getMessage();
            if($e instanceof HttpNotFoundException) $message = "Resource Not Found";

            $error = [ 
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ];

            $this->container->get('Logging')->error($message, $error);

            $response = new Response();
            $response->getBody()->write(json_encode(['errors' => ['message' => $message, $error]]));
            return $response->withStatus(404);
        }
    }
}