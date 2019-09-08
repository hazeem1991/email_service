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
    public $account;

    /**
     * mailjet constructor
     * @param ProviderAccount $account object of the Selected Provider Account
     */
    public function __construct(ProviderAccount $account)
    {
        $this->account = $account;
        $this->sender = new Client($account->getOriginal('username'), $account->getOriginal('password'), true, ["version" => "v3.1"]);
        $this->mail = [
            "Messages" => [
                [
                    "From" => [
                    ],
                    "To" => [
                    ],
                    "Subject" => "",
                    "TextPart" => "",
                    "HTMLPart" => "",
                    "CustomID" => (string)time(),
                ]
            ]
        ];
    }

    /**
     * set the message body
     * @param string type message type
     * @param string body
     * @return Mailer
     */
    public function setBody(string $type, string $body): Mailer
    {
        if ($type == "html") {
            $this->mail["Messages"][0]["HTMLPart"] = $body;
        } else {
            $this->mail["Messages"][0]["TextPart"] = $body;
        }
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
        $this->mail["Messages"][0]["From"] = ["Email" => $email];
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
        $this->mail["Messages"][0]["To"][] = ["Email" => $email];
        return $this;
    }

    /**
     * set the message subject
     * @param string subject
     * @return Mailer
     */
    public function setSubject(string $subject): Mailer
    {
        $this->mail["Messages"][0]["Subject"] = $subject;
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
        $result = $this->sender->post(Resources::$Email, ["body" => $this->mail]);
        $this->result = new MailjetResult($result->getStatus(), $result->getBody(), $result->getData());
        return $this->result;
    }
}