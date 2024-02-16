<?php

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    "PDO" => function() {
        $pdo = new PDO("mysql:host=".'db'.";dbname=".$_ENV["MYSQL_DATABASE"].';charset=utf8', $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
]);
return $containerBuilder->build();