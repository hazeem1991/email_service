<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message as MessageRequest;
use App\Http\Models\Message;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndex(): \Illuminate\Http\JsonResponse
    {
        $messages = Message::orderBy('created_at', "DESC")->get();
        return response()->json(['code' => '00', 'data' => $messages], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * the info that needed to add message .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddMessageForm(): \Illuminate\Http\JsonResponse
    {
        return response()->json();
    }

    /**
     * add the message to the database .
     * @param MessageRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddMessageForm(MessageRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json();
    }

}
