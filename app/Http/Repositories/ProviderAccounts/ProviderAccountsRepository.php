<?php

namespace App\Http\Repositories\ProviderAccounts;

use App\Http\Models\ProviderAccount;
use Illuminate\Database\Eloquent\Collection;

class ProviderAccountsRepository implements ProviderAccountsRepositoryInterface
{
    /**
     * Get's all Accounts.
     *
     * @return Collection
     */
    public function addNewAccount(array $data): ProviderAccount
    {
        return ProviderAccount::create($data);
    }

    /**
     * Add New Account.
     * @param array $data provider account data
     * @return ProviderAccount
     */
    public function getAllAccounts(): Collection
    {
        return ProviderAccount::orderBy("created_at", "DESC")->get();
    }

    /**
     * Get The account info By Id.
     * @param int id the id of the selected provider account
     * @return ProviderAccount
     */
    public function getAccountById(int $id): ProviderAccount
    {
        return ProviderAccount::findOrfail($id);
    }

    /**
     * Update Selected Account Info Id.
     * @param int id the id of the selected provider account
     * @param array $data provider account data
     * @return ProviderAccount
     */
    public function updateAccount(int $id, array $data): ProviderAccount
    {
        $provider = ProviderAccount::findOrfail($id);
        $provider->update($data);
        $provider->save();
        return $provider;
    }

    /**
     * Delete Account By Id Info Id.
     * @param int id the id of the selected provider account
     * @return bool
     */
    public function deleteAccount(int $id): bool
    {
        $provider = ProviderAccount::findOrfail($id);
        return $provider->delete();
    }

    /**
     * get providers that status = 1 and sorted by priority
     * @return bool
     */
    public function getAvailableProviders(): Collection
    {
        $accounts = ProviderAccount::where("status", "=", 1)->orderBy("priority", "ASC")->get();
        return $accounts;
    }
}