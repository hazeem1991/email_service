<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderAccount as ProviderAccountRequest;
use App\Http\Repositories\ProviderAccounts\ProviderAccountsRepositoryInterface as ProviderAccounts;
use \Illuminate\Http\JsonResponse;

class ProviderAccountController extends Controller
{
    protected $provider_account;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProviderAccounts $provider_account)
    {
        $this->provider_account = $provider_account;
    }

    /**
     * list of added accounts .
     * @return JsonResponse
     */
    public function getIndex(): JsonResponse
    {
        $provider_accounts = $this->provider_account->getAllAccounts();
        return response()->json(["code" => "00", "data" => $provider_accounts], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * Info for adding account.
     * @return JsonResponse
     */
    public function getAddAccount(): JsonResponse
    {
        $email_providers = \MainServiceProvider::getSenders();
        return response()->json(["code" => "00", "data" => ["email_providers" => $email_providers]], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * adding account.
     * @param ProviderAccountRequest
     * @return JsonResponse
     */
    public function postAddAccount(ProviderAccountRequest $request): JsonResponse
    {
        $data = $request->validated();
        $provider = $this->provider_account->addNewAccount($data);
        return response()->json(["code" => "00", "msg" => "added_successfully", "data" => ["added_provider" => $provider]], 200, ["Content-Type" => "application/json"]);

    }

    /**
     * Get the Account to edit.
     * @param int $account_id
     * @return JsonResponse
     */
    public function getEditAccount(int $account_id): JsonResponse
    {
        $provider = $this->provider_account->getAccountById($account_id);
        return response()->json(["code" => "00", "data" => ["provider" => $provider]], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * Editing Account.
     * @param ProviderAccountRequest
     * @param int $account_id
     * @return JsonResponse
     */
    public function postEditAccount(ProviderAccountRequest $request, int $account_id): JsonResponse
    {
        $data = $request->validated();
        $provider = $this->provider_account->updateAccount($account_id, $data);
        return response()->json(["code" => "00", "msg" => "edited_successfully", "data" => ["edited_provider" => $provider]], 200, ["Content-Type" => "application/json"]);
    }

    /**
     * Delete Account.
     * @param int $account_id
     * @return JsonResponse
     */
    public function deleteDeleteAccount(int $account_id): JsonResponse
    {
        $provider = $this->provider_account->deleteAccount($account_id);
        return response()->json(["code" => "00", "msg" => "delete_successfully"], 200, ["Content-Type" => "application/json"]);
    }

}
