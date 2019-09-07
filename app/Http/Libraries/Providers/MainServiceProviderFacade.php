<?php

namespace App\Http\Libraries\Providers;

use Illuminate\Support\Facades\Facade;

class MainServiceProviderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return app("MainServiceProvider");
    }
}