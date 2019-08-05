<?php


namespace App\Console\Commands;

use App\Http\Models\Message;

use Exception;
use Illuminate\Console\Command;

class DeletePostsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "send:mail";

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
            $data=$request->validated();
            $data['recipients']=implode(",",$data['recipients']);
            $data=$data+['status'=>0];
            $message=Message::create($data);
            dispatch(new EmailSenderJob($message));
        } catch (Exception $e) {
            $this->error("An error occurred");
        }
    }
}
