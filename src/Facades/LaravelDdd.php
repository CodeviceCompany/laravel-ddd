<?php

namespace CodeviceCompany\LaravelDdd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CodeviceCompany\LaravelDdd\LaravelDdd
 */
class LaravelDdd extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \CodeviceCompany\LaravelDdd\LaravelDdd::class;
    }
}
