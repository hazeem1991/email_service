<?php

namespace App\Http\Libraries\Providers;


use phpDocumentor\Reflection\Types\Self_;

class MainServiceProvider
{
    const AVAILABLE_EMAIL_PROVIDER = ['Mailjet', 'Sendgrid'];

    public function __construct()
    {
    }
    /**
     * Get The MailServer That Implemented .
     * @return []
     */
    public function getSenders():array
    {
        return self::AVAILABLE_EMAIL_PROVIDER;
    }

}