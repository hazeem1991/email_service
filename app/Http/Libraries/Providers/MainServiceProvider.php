<?php

namespace App\Http\Libraries\Providers;


use phpDocumentor\Reflection\Types\Self_;

class MainServiceProvider
{
    const MESSAGE_TYPES=["plain","html"];
    public function __construct()
    {
    }
    /**
     * Get The MailServer That Implemented .
     * @return []
     */
    public function getSenders():array
    {
        return explode(",",env('MAIL_PROVIDERS'));
    }
    public function getMessageTypes():array
    {
        return self::MESSAGE_TYPES;
    }

}