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
    private $result;
    public $account;
    /**
     * sendgrid constructor
     * @param ProviderAccount $account object of the Selected Provider Account
     */
    public function __construct(ProviderAccount $account)
    {
        $this->account = $account;
        $this->sender = new SendGrid($account->getOriginal('password'));
        $this->mail = new Mail();
    }
    /**
     * set the message body
     * @param string type message type
     * @param string body
     * @return Mailer
     */
    public function setBody(string $type, string $body): Mailer
    {
        $this->mail->addContent(
            "text/" . $type, $body
        );
        return $this;
    }
    /**
     * set the message sender
     * @param string email
     * @param string name
     * @return Mailer
     */
    public function setSender(string $email, string $name = null): Mailer
    {
        $this->mail->setFrom($email);
        return $this;
    }
    /**
     * set the message recipient
     * @param string email
     * @param string name
     * @return Mailer
     */
    public function addRecipient(string $email, string $name = null): Mailer
    {
        $this->mail->addTo($email);
        return $this;
    }
    /**
     * set the message subject
     * @param string subject
     * @return Mailer
     */
    public function setSubject(string $subject): Mailer
    {
        $this->mail->setSubject($subject);
        return $this;
    }
    /**
     * set send the message
     * @param Message message object
     * @return MailerResult
     */
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