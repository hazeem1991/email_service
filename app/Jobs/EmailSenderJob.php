<?php

namespace App\Jobs;

use App\Http\Models\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Models\Message;
use App\Http\Models\ProviderAccount;

class EmailSenderJob extends Job
{
    use InteractsWithQueue;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->message->status = 1;
        $this->message->save();
        $accounts = ProviderAccount::where("status", "=", 1)->orderBy('priority', "ASC")->get();
        foreach ($accounts as $account) {
            $mailer = \ExMailer::getMailer($account);
            $result = $mailer->send($this->message);
            if ($result->getStatusCode() == "202" || $result->getStatusCode() == "200") {
                $this->message->status = 2;
                $this->message->save();
                $provider = explode("\\",get_class($mailer));
                Log::create([
                    'sender'=>$this->message->sender,
                    'recipients'=>$this->message->recipients,
                    'rawResponse'=>$result->getRaw(),
                    'provider'=>end($provider)."_id:".$mailer->account->id,
                    'message'=>json_encode($this->message->toArray()),
                    'status'=>1,
                ]);
                break;
            } else {
                $provider =explode("\\",get_class($mailer));
                Log::create([
                    'sender'=>$this->message->sender,
                    'recipients'=>$this->message->recipients,
                    'rawResponse'=>$result->getRaw(),
                    'provider'=>end($provider)."_id:".$mailer->account->id,
                    'message'=>json_encode($this->message->toArray()),
                    'status'=>0,
                ]);
            }
        }
        if ($this->message->status != 2) {
            $this->message->status=3;
            $this->message->save();
            Log::create([
                'sender'=>$this->message->sender,
                'recipients'=>$this->message->recipients,
                'rawResponse'=>"",
                'provider'=>"",
                'message'=>json_encode($this->message->toArray()),
                'status'=>0,
            ]);
            $this->fail(new \Exception("Email Not Send via all providers", 1));
        }
    }
}
