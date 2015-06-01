<?php


namespace Illuminate\ArtificialLegs\Eloquent;

use Cviebrock\EloquentSluggable\SluggableTrait as BaseTrait;
use Illuminate\Container\Container;

/**
 * Class SluggableTrait
 *
 * This is another example of artificial legs for code which was written without an idea that it can be used outside laravel.
 *
 * @package Illuminate\ArtificialLegs\Eloquent
 * @todo Remove dependency on Container.
 */
trait SluggableTrait
{
    use BaseTrait;

    protected function getSluggableConfig()
    {
        $defaults = require(Container::getInstance()->basePath().'/app/config/sluggable.php');

        if (property_exists($this, 'sluggable'))
        {
            return array_merge($defaults, $this->sluggable);
        }

        return $defaults;
    }
}
