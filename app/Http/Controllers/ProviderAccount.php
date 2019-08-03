<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderAccount as ProviderAccountRequest;

class ProviderAccount extends Controller
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
        return response()->json();
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
     * @param Request
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function postAddAccount(Request $request): \Laravel\Lumen\Http\ResponseFactory
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
     * @param ProviderAccount
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function postEditAccount(ProviderAccount $request, int $account_id): \Laravel\Lumen\Http\ResponseFactory
    {
        return response()->json();
    }
}
