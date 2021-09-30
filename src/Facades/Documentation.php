<?php

namespace g4t\Documentation\Facades;

use Illuminate\Support\Facades\Facade;

class Documentation extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'documentation';
    }
}
