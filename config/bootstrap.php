<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require_once __DIR__ . "/../vendor/autoload.php";

$dotEnv = Dotenv::createImmutable(__DIR__ . "/../");
$dotEnv->load();

ini_set("display_errors", boolval($_ENV['DISPLAY_ERRORS']));

$container = require_once __DIR__ . "/container.php";

AppFactory::setContainer($container);