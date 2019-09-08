<?php

namespace App\Http\Services;

use App\Http\Repositories\Messages\MessagesRepositoryInterface as Messages;
use App\Http\Repositories\Logs\LogsRepositoryInterface as Logs;
use App\Http\Repositories\ProviderAccounts\ProviderAccountsRepositoryInterface as Providers;
use App\Jobs\EmailSenderJob;

class SendEmailService
{
    protected $messages;
    protected $logs;
    protected $providers;

    public function __construct(Messages $messages, Logs $logs, Providers $providers)
    {
        $this->messages = $messages;
        $this->logs = $logs;
        $this->providers = $providers;
    }

    /**
     * Send email service that run add the message to database and run the job
     * @param array $data message fields
     * @return void
     */
    public function sendEmail(array $data): void
    {
        $message = $this->messages->AddNewMessage($data);
        dispatch(new EmailSenderJob($message, $logs,$providers));
    }
}