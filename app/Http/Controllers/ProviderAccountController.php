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
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getIndex(): \Laravel\Lumen\Http\ResponseFactory
    {
        $provider_accounts = ProviderAccount::orderBy('created_at', "DESC")->get();
        return response()->json(['code' => '00', 'data' => $provider_accounts], 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Info for adding account.
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getAddAccount(): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }

    /**
     * adding account.
     * @param ProviderAccountRequest
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function postAddAccount(ProviderAccountRequest $request): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }

    /**
     * Get the Account to edit.
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function getEditAccount(Request $request, int $account_id): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }

    /**
     * Editing Account.
     * @param ProviderAccountRequest
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function postEditAccount(ProviderAccountRequest $request, int $account_id): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }
}
