<?php

namespace App\Http\Libraries\EmailSenders;

use App\Http\Models\ProviderAccount;
use App\Http\Libraries\EmailSenders\SendGrid\SendGridMailer;
use App\Http\Libraries\EmailSenders\MailJet\MailjetMailer;
class MailerFactory
{

    public static function getMailer(ProviderAccount $account): Mailer
    {
        $senders_available = \MainServiceProvider::getSenders();
        if (in_array($account->type, $senders_available)) {
            switch ($account->type) {
                case "Sendgrid";
                        return new SendGridMailer($account);
                    break;
                case "Mailjet";
                    return new MailjetMailer($account);
                    break;
                default:
                    throw(new \Exception("Provider Not Available", 1));
                    break;
            }
        } else {
            throw(new \Exception("Provider Not Available", 1));
        }
    }
}