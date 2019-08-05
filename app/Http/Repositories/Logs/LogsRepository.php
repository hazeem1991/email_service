<?php

namespace App\Http\Repositories\Logs;

use App\Http\Models\Log;
use Illuminate\Database\Eloquent\Collection;

class LogsRepository implements LogsRepositoryInterface
{

    public function getLogList(): Collection
    {
        return Log::orderBy('created_at', "DESC")->get();
    }
}