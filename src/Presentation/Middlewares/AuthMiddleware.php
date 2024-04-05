<?php 
namespace App\Presentation\Middlewares;

use Slim\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(private ContainerInterface $container) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeaderLine('Authorization');
        $tokenManager = $this->container->get('TokenManager');
        $decoded = $tokenManager->decode($token);

        if(isset($decoded['error'])) {
            $response = new Response();
            $responseBody = $response->getBody();
            $responseBody->write(json_encode([
                'errors' => [
                    'message' => $decoded['error']
                ]
            ]));
    
            return $response
            ->withStatus(401)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader("Cache-Control", "no-cache")
            ->withHeader("Cache-Control", "max-age=0")
            ->withHeader("Cache-Control", "must-revalidate")
            ->withHeader("Cache-Control", "proxy-revalidate")
            ->withBody($responseBody);
        }

        return $handler->handle($request);
    }
}