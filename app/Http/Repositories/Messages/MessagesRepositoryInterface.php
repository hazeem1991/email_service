<?php

namespace App\Http\Repositories\Messages;

use App\Http\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface MessagesRepositoryInterface
{
    /**
     * Get's all Messages.
     *
     * @return mixed
     */
    public function getAllMessages(): Collection;

    /**
     * Get's all Messages.
     *
     * @return mixed
     */
    public function AddNewMessage(array $data);

}