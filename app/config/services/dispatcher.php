<?php

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

$container = Container::getInstance();

$container->singleton('dispatcher', function(Container $c) {
    return new \Illuminate\Events\Dispatcher($c);
});

$container->alias('dispatcher', 'events');

Model::setEventDispatcher($container['dispatcher']);
