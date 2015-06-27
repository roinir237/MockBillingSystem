<?php

use Curve\AppKernel;

require_once __DIR__  . '/vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__  . '/src/Curve/AppContainer.php');
$container = $containerBuilder->build();

/** @var AppKernel $app */
$app = $container->get("Curve\\AppKernel");

$input = json_decode(file_get_contents($argv[1]), true);

echo $app->start($input)->getTotal() . "\n";
