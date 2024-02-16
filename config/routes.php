<?php 

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get("/", function(Request $request, Response $response, array $args) {
    $response->getBody()->write(json_encode("oi"));
    return $response;
});

// Fallback
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],'/{routes:.+}', function(Request $request, Response $response) {
    $response->getBody()->write(json_encode('Resource Not Found'));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
});