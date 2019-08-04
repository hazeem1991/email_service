<?php

namespace App\Http\Libraries\EmailSenders;

use App\Http\Models\Message;
use App\Http\Models\ProviderAccount;
use SendGrid\Mail\Mail;
use SendGrid;

class SendGridMailer implements Mailer
{
    private $sender;
    private $mail;

    public function __construct(ProviderAccount $account)
    {
        $this->sender = new SendGrid($account->password);
        $this->mail = new Mail();
    }

    public function setBody(string $type, string $body): Mailer
    {
        $this->mail->addContent(
            "text/" . $type, $body
        );
        return $this;
    }

    public function setSender(string $email, string $name = null): Mailer
    {
        $this->mail->setFrom($email);
        return $this;
    }

    public function addRecipient(string $email, string $name = null): Mailer
    {
        $this->mail->addTo($email);
        return $this;
    }

    public function setSubject(string $subject): Mailer
    {
        $this->mail->setSubject($subject);
        return $this;
    }

    public function send(Message $message)
    {
        $this->setSender($message->sender)
            ->setSubject($message->subject)
            ->setBody($message->type, $message->body);
        $recipients = explode(",", $message->recipients);
        foreach ($recipients as $recipient) {
            $this->addRecipient($recipient);
        }
        $response = $this->sender->client->mail()->send()->post($this->mail);
        return $response;
    }
}