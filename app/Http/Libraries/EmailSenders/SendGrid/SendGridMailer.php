<?php

namespace App\Http\Libraries\EmailSenders\SendGrid;

use App\Http\Models\Message;
use App\Http\Models\ProviderAccount;
use App\Http\Libraries\EmailSenders\Mailer;
use App\Http\Libraries\EmailSenders\MailerResult;
use SendGrid\Mail\Mail;
use SendGrid;

class SendGridMailer implements Mailer
{
    private $sender;
    private $mail;
    public $result;

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

    public function send(Message $message): MailerResult
    {
        $this->setSender($message->sender)
            ->setSubject($message->subject)
            ->setBody($message->type, $message->body);
        $recipients = explode(",", $message->recipients);
        foreach ($recipients as $recipient) {
            $this->addRecipient($recipient);
        }
        $result = $this->sender->client->mail()->send()->post($this->mail);
        $this->result = new SendGridResult($result->statusCode(), $result->body(), $result->headers());
        return $this->result;
    }
}