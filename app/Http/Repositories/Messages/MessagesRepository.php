<?php

namespace App\Http\Repositories\Messages;

use App\Http\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessagesRepository implements MessagesRepositoryInterface
{
    public function AddNewMessage(array $data): Message
    {
        $data['recipients']=implode(",",$data['recipients']);
        $data=$data+['status'=>0];
        return Message::create($data);
    }

    public function getAllMessages(): Collection
    {
        return Message::orderBy('created_at', "DESC")->get();
    }
}