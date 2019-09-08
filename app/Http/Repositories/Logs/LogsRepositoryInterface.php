<?php

namespace App\Http\Repositories\Logs;

use App\Http\Models\Log;
use Illuminate\Database\Eloquent\Collection;

interface LogsRepositoryInterface
{
    /**
     * Get's all Logs.
     *
     * @return Collection
     */
    public function getLogList(): Collection;

    /**
     * add log to the database.
     * @param array $data log fields
     * @return Log
     */
    public function addToLog(array $data): Log;
}