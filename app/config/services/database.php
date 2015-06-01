<?php

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

$container = Container::getInstance();

$container->bind('migration-table', function() { return 'migrations'; });
$container->bind('db-config', function() { return [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'eloquent-test',
    'username' => 'root',
    'password' => '*********',
    'charset' => 'utf8',
    'prefix' => '',
    'schema' => 'public',
    'collation' => 'utf8_general_ci'
]; });

$container->singleton('db', function(Container $c) {
    $manager = new \Illuminate\Database\Capsule\Manager($c);
    $manager->addConnection($c['db-config']);
    $manager->setAsGlobal();
    $manager->bootEloquent();

    return $manager;

});

$container->singleton('connection', function(Container $c) {
    return $c['db']->getConnection('default');
});

$container->singleton('resolver', function(Container $c) {
    $resolver = new \Illuminate\Database\ConnectionResolver(['default' => $c['connection']]);
    $resolver->setDefaultConnection('default');

    return $resolver;
});

$container->singleton('migration-repo', function(Container $c) {
    return new \Illuminate\Database\Migrations\DatabaseMigrationRepository($c['resolver'], $c['migration-table']);
});

$container->singleton('migration-creator', function(Container $c) {
    return new \Illuminate\Database\Migrations\MigrationCreator($c['filesystem']);
});

$container->singleton('migrator', function(Container $c) {
    return new Illuminate\Database\Migrations\Migrator($c['migration-repo'], $c['resolver'], $c['filesystem']);
});

Model::setConnectionResolver($container['resolver']);
