<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Models\ProviderAccount;
class ProviderAccountUnitTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testAddProviderAccount()
    {
        $message=factory(ProviderAccount::class)->make();
        $this->seeInDatabase('email_provider_accounts', ['id' => $message->id]);
    }
}