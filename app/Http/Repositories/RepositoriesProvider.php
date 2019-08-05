<?php

namespace App\Http\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            \App\Http\Repositories\Messages\MessagesRepositoryInterface::class,
            \App\Http\Repositories\Messages\MessagesRepository::class
        );

        $this->app->bind(
            \App\Http\Repositories\ProviderAccounts\ProviderAccountsRepositoryInterface::class,
            \App\Http\Repositories\ProviderAccounts\ProviderAccountsRepository::class
        );
        $this->app->bind(
            \App\Http\Repositories\Logs\LogsRepositoryInterface::class,
            \App\Http\Repositories\Logs\LogsRepository::class
        );
    }
}