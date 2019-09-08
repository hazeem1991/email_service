<?php

namespace App\Http\Repositories\ProviderAccounts;

use App\Http\Models\ProviderAccount;
use Illuminate\Database\Eloquent\Collection;

interface ProviderAccountsRepositoryInterface
{
    /**
     * Get's all Accounts.
     *
     * @return Collection
     */
    public function getAllAccounts(): Collection;

    /**
     * Add New Account.
     * @param array $data provider account data
     * @return ProviderAccount
     */
    public function addNewAccount(array $data): ProviderAccount;

    /**
     * Get The account info By Id.
     * @param int id the id of the selected provider account
     * @return ProviderAccount
     */
    public function getAccountById(int $id): ProviderAccount;

    /**
     * Update Selected Account Info Id.
     * @param int id the id of the selected provider account
     * @param array $data provider account data
     * @return ProviderAccount
     */
    public function updateAccount(int $id, array $data): ProviderAccount;

    /**
     * Delete Account By Id Info Id.
     * @param int id the id of the selected provider account
     * @return bool
     */
    public function deleteAccount(int $id): bool;

}