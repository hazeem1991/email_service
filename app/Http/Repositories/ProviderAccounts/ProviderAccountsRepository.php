<?php

namespace App\Http\Repositories\ProviderAccounts;

use App\Http\Models\ProviderAccount;
use Illuminate\Database\Eloquent\Collection;

class ProviderAccountsRepository implements ProviderAccountsRepositoryInterface
{
    public function addNewAccount(array $data): ProviderAccount
    {
        return ProviderAccount::create($data);
    }

    public function getAllAccounts(): Collection
    {
        return ProviderAccount::orderBy("created_at", "DESC")->get();
    }

    public function getAccountById(int $id): ProviderAccount
    {
        return ProviderAccount::findOrfail($id);
    }

    public function updateAccount(int $id, array $data): ProviderAccount
    {
        $provider = ProviderAccount::findOrfail($id);
        $provider->update($data);
        $provider->save();
        return $provider;
    }

    public function deleteAccount(int $id): bool
    {
        $provider = ProviderAccount::findOrfail($id);
        return $provider->delete();
    }
}