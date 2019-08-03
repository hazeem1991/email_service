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
        return response()->json();
    }

    /**
     * adding account.
     * @param ProviderAccountRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddAccount(ProviderAccountRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json();
    }

    /**
     * Get the Account to edit.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEditAccount(Request $request, int $account_id): \Illuminate\Http\JsonResponse
    {
        return response()->json();
    }

    /**
     * Editing Account.
     * @param ProviderAccountRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditAccount(ProviderAccountRequest $request, int $account_id): \Illuminate\Http\JsonResponse
    {
        return response()->json();
    }
}
