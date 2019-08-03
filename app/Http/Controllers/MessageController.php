<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message as MessageRequest;

class MessageController extends Controller
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
     * list of the messages that was sent .
     *
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getIndex(): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }

    /**
     * the info that needed to add message .
     *
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getAddMessageForm(): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }

    /**
     * add the message to the database .
     * @param MessageRequest
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function postAddMessageForm(MessageRequest $request): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }

}
