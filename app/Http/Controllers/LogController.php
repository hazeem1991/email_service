<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Logs\LogsRepositoryInterface as Logs;
use \Illuminate\Http\JsonResponse;

class LogController extends Controller
{
    protected $logs;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Logs $logs)
    {
        $this->logs = $logs;
    }

    /**
     * Return  list of the log .
     *
     * @return JsonResponse
     */
    public function getIndex(): JsonResponse
    {
        $log = $this->logs->getLogList();
        return response()->json(["code" => "00", "data" => $log], 200, ["Content-Type" => "application/json"]);
    }
}
