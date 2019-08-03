<?php

namespace App\Http\Libraries\MailSenders;

interface Mailer
{
    public function setBody(string $type,string $body): void;

    public function setSender(string $email,string $name): void;

    public function addRecipient(string $email,string $name): void;

    public function setSubject(string $subject): void;

    public function send(): void;
}