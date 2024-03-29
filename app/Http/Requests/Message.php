<?php

namespace App\Http\Requests;
/**
 * Class Message.
 */
class Message extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "sender" => "required|email",
            "recipients" => "required|array",
            "recipients.*" => "email",
            "subject" => "required",
            "type" => "required|in:" . implode(",", \MainServiceProvider::getMessageTypes()),
            "body" => "required"
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}