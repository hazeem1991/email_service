<?php

namespace App\Http\Libraries\EmailSenders;


interface MailerResult
{
    public function __construct(...$args);

    public function getStatusCode(): string;

    public function getMessage(): string;

    public function getHeaders(): array ;
}