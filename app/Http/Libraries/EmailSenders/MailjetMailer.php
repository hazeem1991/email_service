<?php

namespace App\Http\Libraries\EmailSenders;

use App\Http\Models\Message;
use App\Http\Models\ProviderAccount;

class MailjetMailer implements Mailer
{
    public function __construct(ProviderAccount $account)
    {

    }
    public function setBody(string $type, string $body): Mailer
    {

    }

    public function setSender(string $email, string $name): Mailer
    {

    }

    public function addRecipient(string $email, string $name): Mailer
    {

    }

    public function setSubject(string $subject): Mailer
    {

    }

    public function send(Message $message)
    {

    }
}