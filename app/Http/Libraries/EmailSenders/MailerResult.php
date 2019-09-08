<?php

namespace App\Http\Libraries\EmailSenders;


interface MailerResult
{
    public function __construct(...$args);

    /**
     * get status code
     * @return  string
     */
    public function getStatusCode(): string;

    /**
     * get response message
     * @return  string
     */
    public function getMessage(): string;

    /**
     * get response header
     * @return  array
     */
    public function getHeaders(): array;

    /**
     * get raw response
     * @return  string
     */
    public function getRaw(): string;
}