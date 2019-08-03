<?php

namespace App\Http\Controllers;

use App\Http\Models\Log;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return  list of the log .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndex(): \Illuminate\Http\JsonResponse
    {
        $log = Log::orderBy('created_at', "DESC")->get();
        return response()->json(['code' => '00', 'data' => $log], 200, ['Content-Type' => 'application/json']);
    }
}
