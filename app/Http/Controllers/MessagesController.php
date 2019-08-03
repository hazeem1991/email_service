<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Http\Request;

class MessagesController extends Controller
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
     * Return list of the messages that was sent .
     *
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getIndex():\Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }
    /**
     * Return  the info that needed to add message .
     *
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getAddMessageForm():\Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }
    /**
     * Return  add the message to the database .
     * @param Request
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function postAddMessageForm(Request $request):\Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }

}
