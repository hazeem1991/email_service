<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Models\ProviderAccount;

class CommandUnitTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCommandMessage()
    {
        $provider_account = factory(ProviderAccount::class)->create();
        $this->assertEquals(0,$this->artisan("sendmail 'sender@mail.com' 'recipent@mail.com' 'Subject' 'Body' --env=testing"));
    }

}
