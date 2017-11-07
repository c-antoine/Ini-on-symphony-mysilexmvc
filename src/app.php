<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();

// Ajout des fournisseurs de services
$app->register(new DoctrineServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

//Repo user, repo pc && repo link which needs both 
$app['repository.user'] = function ($app) {
    return new App\Users\Repository\UserRepository($app['db']);
};
$app['repository.pc'] = function ($app) {
    return new App\Pcs\Repository\PcRepository($app['db']);
};
$app['repository.link'] = function ($app) {
    return new App\Links\Repository\LinkRepository($app['db'], $app['repository.user'], $app['repository.pc']);
};
