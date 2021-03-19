<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require_once __DIR__ . "/vendor/autoload.php";

$containerBuilder = new ContainerBuilder();
$settings = require __DIR__ . '/config/settings.php';
$containerBuilder->addDefinitions($settings);

$container = $containerBuilder->build();

$app = AppFactory::createFromContainer($container);

require_once "routes.php";
