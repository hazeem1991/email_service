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
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getIndex():\Laravel\Lumen\Http\ResponseFactory
    {
        $log=Log::orderBy('created_at',"DESC")->get();
        return response()->json(['code'=>'00','data'=> $log],200,['Content-Type'=>'application/json']);
    }
}
