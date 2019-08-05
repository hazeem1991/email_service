<?php

namespace App\Http\Repositories\ProviderAccounts;

use App\Http\Models\ProviderAccount;
use Illuminate\Database\Eloquent\Collection;

interface ProviderAccountsRepositoryInterface
{
    /**
     * Get's all Accounts.
     *
     * @return ProviderAccount
     */
    public function getAllAccounts(): Collection;

    /**
     * Add New Account.
     *
     * @return ProviderAccount
     */
    public function addNewAccount(array $data): ProviderAccount;

    /**
     * Get The account info By Id.
     *
     * @return ProviderAccount
     */
    public function getAccountById(int $id): ProviderAccount;

    /**
     * Update Selected Account Info Id.
     *
     * @return ProviderAccount
     */
    public function updateAccount(int $id, array $data): ProviderAccount;

    /**
     * Delete Account By Id Info Id.
     *
     * @return bool
     */
    public function deleteAccount(int $id): bool;

}