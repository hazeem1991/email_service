<?php


namespace App\Console\Commands;

use App\Http\Models\Message;

use Exception;
use Illuminate\Console\Command;
use App\Jobs\EmailSenderJob;

class SendMailCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "sendmail {sender} {recipient} {subject} {body}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Send Mail By Command";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $data["sender"] = $this->argument("sender");
            $data["subject"] = $this->argument("subject");
            $data["body"] = $this->argument("body");
            $data["recipients"] = $this->argument("recipient");
            $data = $data + ["type" => "plain"];
            $data = $data + ["status" => 0];
            $message = Message::create($data);
            dispatch(new EmailSenderJob($message));
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
