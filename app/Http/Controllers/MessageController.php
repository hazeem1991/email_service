<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message as MessageRequest;
use App\Http\Repositories\Messages\MessagesRepositoryInterface as Messages;
use App\Http\Services\SendEmailService;
class MessageController extends Controller
{
    protected $messages;
    protected $send_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Messages $messages,SendEmailService $send_service)
    {
        $this->messages = $messages;;
        $this->send_service=$send_service;
    }

    /**
     * list of the messages that was sent .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndex(): \Illuminate\Http\JsonResponse
    {
        $messages = $this->messages->getAllMessages();
        return response()->json(["code" => "00", "data" => $messages], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * the info that needed to add message .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddMessageForm(): \Illuminate\Http\JsonResponse
    {
        $message_types = \MainServiceProvider::getMessageTypes();
        return response()->json(["code" => "00", "data" => ["message_types" => $message_types]], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * add the message to the database .
     * @param MessageRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddMessageForm(MessageRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $this->send_service->SendEmail($data);
        return response()->json(["code" => "00", "msg" => "added_successfully"], 200, ["Content-Type" => "application/json"]);
    }

}
