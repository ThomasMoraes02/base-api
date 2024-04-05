<?php 

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use App\Presentation\Controllers\AuthController;
use App\Presentation\Middlewares\AuthMiddleware;
use App\Presentation\Middlewares\CorsMiddleware;
use App\Presentation\Middlewares\ErrorMiddleware;
use App\Presentation\Middlewares\OutputJsonMiddleware;

$app = AppFactory::create();

$app->get("/", function(Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello World!");
    return $response;
});

$app->add(ErrorMiddleware::class);
$app->add(OutputJsonMiddleware::class);

$app->post("/api/v1/auth", [AuthController::class, "store"]);

$app->group("/api/v1",function(RouteCollectorProxy $group) {
    $group->get("/test", function(Request $request, Response $response) {
        $response->getBody()->write(json_encode("Hello World Authenticated!"));
        return $response;
    });
    // Routes Here!!!
})->add(AuthMiddleware::class)->add(CorsMiddleware::class);