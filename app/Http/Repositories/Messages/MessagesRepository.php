<?php

namespace App\Http\Repositories\Messages;

use App\Http\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessagesRepository implements MessagesRepositoryInterface
{
    /**
     * function to add message
     * @param array $data the message fields
     * @return Message
    */
    public function AddNewMessage(array $data): Message
    {
        $data["recipients"] = implode(",", $data["recipients"]);
        $data = $data + ["status" => 0];
        return Message::create($data);
    }
    /**
     * function get list of messages
     * @return Collection
     */
    public function getAllMessages(): Collection
    {
        return Message::orderBy("created_at", "DESC")->get();
    }
}