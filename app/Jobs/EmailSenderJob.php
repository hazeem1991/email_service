<?php

namespace App\Jobs;

use Illuminate\Queue\InteractsWithQueue;
use App\Http\Models\Message;
use App\Http\Repositories\Logs\LogsRepositoryInterface as Logs;
use App\Http\Repositories\ProviderAccounts\ProviderAccountsRepositoryInterface as Providers;

class EmailSenderJob extends Job
{
    use InteractsWithQueue;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $message;
    public $logs;
    public $providers;

    public function __construct(Message $message, Logs $logs, Providers $providers)
    {
        $this->message = $message;
        $this->logs = $logs;
        $this->providers = $providers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //set the message status to sending
        $this->message->status = 1;
        $this->message->save();
        // get the available provider account
        $accounts = $this->providers->getAvailableProviders();
        //loop throw the accounts that ordered by priority to try to send
        foreach ($accounts as $account) {
            //use the mailer factory to get sender object
            $mailer = \ExMailer::getMailer($account);
            //send the message
            $result = $mailer->send($this->message);
            //check the response if the message sent or not if sent the foreach will break
            //if not the code will test with the next account
            if ($result->getStatusCode() == "202" || $result->getStatusCode() == "200") {
                //set the message is sent
                $this->message->status = 2;
                $this->message->save();
                $provider = explode("\\", get_class($mailer));
                //add to log
                $this->logs->addToLog([
                    "sender" => $this->message->sender,
                    "recipients" => $this->message->recipients,
                    "rawResponse" => $result->getRaw(),
                    "provider" => end($provider) . "_id:" . $mailer->account->id,
                    "message" => json_encode($this->message->toArray()),
                    "status" => 1,
                ]);
                break;
            } else {
                //if not sent code will log the try is faild
                $provider = explode("\\", get_class($mailer));
                $this->logs->addToLog([
                    "sender" => $this->message->sender,
                    "recipients" => $this->message->recipients,
                    "rawResponse" => $result->getRaw(),
                    "provider" => end($provider) . "_id:" . $mailer->account->id,
                    "message" => json_encode($this->message->toArray()),
                    "status" => 0,
                ]);
            }
        }
        //if there is no more account and the message is not sent set the message to fail and log and set the job to fail
        if ($this->message->status != 2) {
            $this->message->status = 3;
            $this->message->save();
            $this->logs->addToLog([
                "sender" => $this->message->sender,
                "recipients" => $this->message->recipients,
                "rawResponse" => "",
                "provider" => "",
                "message" => json_encode($this->message->toArray()),
                "status" => 0,
            ]);
            $this->fail(new \Exception("Email Not Send via all providers", 1));
        }
    }
}
