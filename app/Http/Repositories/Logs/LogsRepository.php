<?php

namespace App\Http\Repositories\Logs;

use App\Http\Models\Log;
use Illuminate\Database\Eloquent\Collection;

class LogsRepository implements LogsRepositoryInterface
{
    /**
     * Get's all Logs.
     *
     * @return Collection
     */
    public function getLogList(): Collection
    {
        return Log::orderBy("created_at", "DESC")->get();
    }

    /**
     * add log to the database.
     * @param array $data log fields
     * @return Log
     */
    public function addToLog(array $data): Log
    {
        return Log::create($data);
    }
}