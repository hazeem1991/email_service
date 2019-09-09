<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Models\ProviderAccount;

class MessagesTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListMessages()
    {
        $response = $this->get('/messages', ['accept' => 'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }

    public function testAddMessages()
    {
        $provider_account = factory(ProviderAccount::class)->create();
        $response = $this->get('/messages/add', ['accept' => 'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
        $response = $this->post('/messages/add', ['body' => "test"], ['accept' => 'application/json']);
        $this->assertEquals(422, $this->response->status());

        $response = $this->post('/messages/add', [
            'body' => "test",
            'sender' => "hazeem@live.it",
            'recipients' => ["hazeem@live.it"],
            'subject' => 'test',
            'type' => 'html',
        ], ['accept' => 'application/json']);
        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }
}
