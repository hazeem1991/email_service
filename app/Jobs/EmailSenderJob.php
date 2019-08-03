<?php

namespace App\Jobs;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Models\Message;
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
        $this->message=$message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->message->status=1;
        $this->message->save();
        dd($this->message);
    }
}
