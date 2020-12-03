<?php

namespace Occsz\OccszApi\Facades;

use Illuminate\Support\Facades\Facade;

class OccszApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'occsz-api';
    }
}
