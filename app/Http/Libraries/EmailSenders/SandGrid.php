<?php

namespace App\Http\Libraries\MailSenders;

use App\Http\Models\Message;
use App\Http\Models\ProviderAccount;

class SandGrid implements Mailer
{
    public function __construct(ProviderAccount $account)
    {

    }
    public function setBody(string $type, string $body): void
    {

    }

    public function setSender(string $email, string $name): void
    {

    }

    public function addRecipient(string $email, string $name): void
    {

    }

    public function setSubject(string $subject): void
    {

    }

    public function send(Message $message): void
    {

    }
}