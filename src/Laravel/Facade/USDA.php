<?php

namespace stekel\FoodDatabase\Laravel\Facade;

use Illuminate\Support\Facades\Facade;

class USDA extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'usda';
    }
}