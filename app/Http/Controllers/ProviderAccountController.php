<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderAccount as ProviderAccountRequest;
use App\Http\Models\ProviderAccount;

class ProviderAccountController extends Controller
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
     * list of added accounts .
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIndex(): \Illuminate\Http\JsonResponse
    {
        $provider_accounts = ProviderAccount::orderBy('created_at', "DESC")->get();
        return response()->json(['code' => '00', 'data' => $provider_accounts], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Info for adding account.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddAccount(): \Illuminate\Http\JsonResponse
    {
        $email_providers = \MainServiceProvider::getSenders();
        return response()->json(['code' => '00', 'data' => ["email_providers" => $email_providers]], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * adding account.
     * @param ProviderAccountRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddAccount(ProviderAccountRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $provider = ProviderAccount::create($data);
        return response()->json(['code' => '00', 'msg' => "added_successfully", 'data' => ["added_provider" => $provider]], 200, ['Content-Type' => 'application/json']);

    }

    /**
     * Get the Account to edit.
     * @param int $account_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEditAccount(int $account_id): \Illuminate\Http\JsonResponse
    {
        $provider = ProviderAccount::findOrfail($account_id);
        return response()->json(['code' => '00', 'data' => ["provider" => $provider]], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Editing Account.
     * @param ProviderAccountRequest
     * @param int $account_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditAccount(ProviderAccountRequest $request, int $account_id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $provider = ProviderAccount::findOrfail($account_id);
        $provider->update($data);
        $provider->save();
        return response()->json(['code' => '00', 'msg' => "edited_successfully", 'data' => ["edited_provider" => $provider]], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Delete Account.
     * @param int $account_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDeleteAccount(int $account_id): \Illuminate\Http\JsonResponse
    {
        $provider = ProviderAccount::findOrfail($account_id);
        $provider->delete();
        return response()->json(['code' => '00', 'msg' => "delete_successfully"], 200, ['Content-Type' => 'application/json']);
    }

}
