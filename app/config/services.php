<?php

use Illuminate\ArtificialLegs\ApplicationMock;
use Illuminate\Container\Container;

// Instantiate Container
$container = new ApplicationMock();

$container->singleton('container', function($c) {
    return $c;
});

$container->bind('filesystem', '\Illuminate\Filesystem\Filesystem');

Container::setInstance($container);

$services = new DirectoryIterator(__DIR__.'/services');

foreach ($services as $definition) {
    if ($definition->isFile()) {
        require_once $definition->getRealPath();
    }
}

$container->register(new Cviebrock\EloquentSluggable\SluggableServiceProvider($container));

\Illuminate\Support\Facades\Facade::setFacadeApplication($container);



