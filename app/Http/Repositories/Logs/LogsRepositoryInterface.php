<?php

namespace App\Http\Repositories\Logs;

use App\Http\Models\Log;
use Illuminate\Database\Eloquent\Collection;

interface LogsRepositoryInterface
{
    /**
     * Get's all Logs.
     *
     * @return mixed
     */
    public function getLogList(): Collection;

}