<?php
// DIC configuration

use App\Repositories\IndispensableRepository;
use App\Services\UsefulService;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['database'] = function ($c) {
    return new PDO('mysql:host=' . getenv('DATA_DB_HOST') . ';dbname=gonano', getenv('DATA_DB_USER'), getenv('DATA_DB_PASS'));
};

$container[UsefulService::class] = function ($c) {
    return new UsefulService(
        $c[IndispensableRepository::class],
        $c['logger']
    );
};

$container[IndispensableRepository::class] = function ($c) {
    return new IndispensableRepository(
        $c['database']
    );
};

