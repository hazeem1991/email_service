<?php

namespace App\Http\Libraries\EmailSenders\MailJet;

use App\Http\Models\Message;
use App\Http\Models\ProviderAccount;
use App\Http\Libraries\EmailSenders\Mailer;
use App\Http\Libraries\EmailSenders\MailerResult;
use Mailjet\Resources;
use Mailjet\Client;

class MailjetMailer implements Mailer
{
    private $sender;
    private $mail;
    public $result;
    public function __construct(ProviderAccount $account)
    {
        $this->sender = new Client($account->username,$account->password,true,['version' => 'v3.1']);
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

    public function send(Message $message): MailerResult
    {

    }
}