<?php

namespace App\Http\Services;

use App\Http\Requests\Message as MessageRequest;
use App\Http\Repositories\Messages\MessagesRepositoryInterface as Messages;
use App\Jobs\EmailSenderJob;

class SendEmailService
{
    protected $messages;

    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
    }

    public function sendEmail(array $data): void
    {
        $message = $this->messages->AddNewMessage($data);
        dispatch(new EmailSenderJob($message));
    }
}