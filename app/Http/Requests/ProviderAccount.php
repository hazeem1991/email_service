<?php
namespace App\Http\Requests;
/**
 * Class ProviderAccount.
 */
class ProviderAccount extends FormRequest
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
            'type'=>'required|in:' . implode(',', \MainServiceProvider::getSenders()),
            'status'=>'required',
            'username'=>'required',
            'password'=>'required',
            'priority'=>"required|unique:email_provider_accounts|numeric"
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}