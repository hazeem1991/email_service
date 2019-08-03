<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderAccount extends Controller
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
     * Return  list off added accounts .
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getIndex():\Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }
    /**
     * Return  Info for adding account.
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getAddAccount():\Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }
    /**
     * Return  Info for adding account.
     * @param Request
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function postAddAccount(Request $request):\Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }
}
