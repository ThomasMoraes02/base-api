<?php 
namespace App\Presentation\Controllers;

use App\Application\UseCases\Auth\CreateToken;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Psr\Container\ContainerInterface;
use App\Infraestructure\Auth\TokenManager;

class AuthController
{
    private readonly TokenManager $tokenManager;

    public function __construct(ContainerInterface $container)
    {
        $this->tokenManager = $container->get('TokenManager');
    }

    public function store(Request $request, Response $response, array $args): Response
    {
        $input = json_decode($request->getBody()->getContents(), true);
        $output = (new CreateToken($this->tokenManager))->execute($input);
        $response->getBody()->write(json_encode($output, JSON_UNESCAPED_UNICODE));
        return $response->withStatus(201);
    }
}