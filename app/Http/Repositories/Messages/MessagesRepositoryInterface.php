<?php

namespace App\Http\Repositories\Messages;

use App\Http\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface MessagesRepositoryInterface
{
    /**
     * function get list of messages
     *
     * @return Collection
     */
    public function getAllMessages(): Collection;

    /**
     * function to add message
     * @param array $data the message fields
     * @return mixed
     */
    public function AddNewMessage(array $data);

}