<?php 

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use App\Presentation\Controllers\AuthController;
use App\Presentation\Middlewares\ErrorMiddleware;
use App\Presentation\Middlewares\OutputJsonMiddleware;

$app = AppFactory::create();

$app->get("/", function(Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello World!");
    return $response;
});

$app->post("/api/v1/auth", [AuthController::class, "store"]);

$app->group("/api/v1",function(RouteCollectorProxy $group) {
    // Routes Here!!!
});

$app->add(ErrorMiddleware::class);
$app->add(OutputJsonMiddleware::class);