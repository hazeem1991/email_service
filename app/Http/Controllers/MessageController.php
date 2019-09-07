<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message as MessageRequest;
use App\Http\Repositories\Messages\MessagesRepositoryInterface as Messages;
use App\Http\Services\SendEmailService;
use \Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    protected $messages;
    protected $send_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Messages $messages, SendEmailService $send_service)
    {
        $this->messages = $messages;;
        $this->send_service = $send_service;
    }

    /**
     * list of the messages that was sent .
     *
     * @return JsonResponse
     */
    public function getIndex(): JsonResponse
    {
        $messages = $this->messages->getAllMessages();
        return response()->json(["code" => "00", "data" => $messages], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * the info that needed to add message .
     *
     * @return JsonResponse
     */
    public function getAddMessageForm(): JsonResponse
    {
        $message_types = \MainServiceProvider::getMessageTypes();
        return response()->json(["code" => "00", "data" => ["message_types" => $message_types]], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * add the message to the database .
     * @param MessageRequest
     * @return JsonResponse
     */
    public function postAddMessageForm(MessageRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->send_service->SendEmail($data);
        return response()->json(["code" => "00", "msg" => "added_successfully"], 200, ["Content-Type" => "application/json"]);
    }

}
