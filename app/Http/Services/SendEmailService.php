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
    /**
     * Send email service that run add the message to database and run the job
     * @param array $data message fields
     * @return void
    */
    public function sendEmail(array $data): void
    {
        $message = $this->messages->AddNewMessage($data);
        dispatch(new EmailSenderJob($message));
    }
}