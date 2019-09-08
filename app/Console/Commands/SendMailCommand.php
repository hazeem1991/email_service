<?php


namespace App\Console\Commands;

use App\Http\Models\Message;

use Exception;
use Illuminate\Console\Command;
use App\Jobs\EmailSenderJob;
use App\Http\Services\SendEmailService;

class SendMailCommand extends Command
{
    protected $send_service;

    public function __construct(SendEmailService $send_service)
    {
        $this->send_service = $send_service;
        parent::__construct();
    }

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
            $data["recipients"] = explode(",", $this->argument("recipient"));
            $data = $data + ["type" => "plain"];
            $data = $data + ["status" => 0];
            $this->send_service->SendEmail($data);
            $this->info("Message Sent to {$this->argument("recipient")}");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
