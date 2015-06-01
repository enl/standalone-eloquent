<?php

use Illuminate\Container\Container;

$container = Container::getInstance();

$container->singleton('console', function(Container $c) {
    $cli = new \Illuminate\Console\Application($c, $c['dispatcher'], '1.0');

    $cli->addCommands($c->tagged('console.command'));

    return $cli;
});

$container->singleton('console.migrations.install', function(Container $c) {
    return new Illuminate\Database\Console\Migrations\InstallCommand($c['migration-repo']);
});
$container->singleton('console.migrations.migrate', function(Container $c) {
    return new Illuminate\Database\Console\Migrations\MigrateCommand($c['migrator']);
});
$container->singleton('console.migrations.rollback', function(Container $c) {
    return new \Illuminate\Database\Console\Migrations\RollbackCommand($c['migrator']);
});
$container->singleton('console.migrations.reset', function(Container $c) {
    return new \Illuminate\Database\Console\Migrations\ResetCommand($c['migrator']);
});


$container->singleton('console.migrations.make', function(Container $c) {
    return new Illuminate\Database\Console\Migrations\MigrateMakeCommand($c['migration-creator'], new \Illuminate\Foundation\Composer($c['filesystem']));
});

$container->tag(['console.migrations.install', 'console.migrations.migrate', 'console.migrations.make', 'console.migrations.rollback', 'console.migrations.reset'], 'console.command');

