<?php

namespace App\Http\Libraries\EmailSenders;

use App\Http\Models\Message;
use App\Http\Models\ProviderAccount;

interface Mailer
{
    /**
     * constructor
     * @param ProviderAccount $account object of the Selected Provider Account
     */
    public function __construct(ProviderAccount $account);

    /**
     * set the message body
     * @param string type message type
     * @param string body
     * @return Mailer
     */
    public function setBody(string $type, string $body): Mailer;

    /**
     * set the message sender
     * @param string email
     * @param string name
     * @return Mailer
     */
    public function setSender(string $email, string $name): Mailer;

    /**
     * set the message recipient
     * @param string email
     * @param string name
     * @return Mailer
     */
    public function addRecipient(string $email, string $name): Mailer;

    /**
     * set the message subject
     * @param string subject
     * @return Mailer
     */
    public function setSubject(string $subject): Mailer;

    /**
     * set send the message
     * @param Message message object
     * @return MailerResult
     */
    public function send(Message $message): MailerResult;
}