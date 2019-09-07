<?php

namespace App\Http\Libraries\EmailSenders;

use Illuminate\Support\Facades\Facade;

class MailFactoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return app("ExMailer");
    }
}