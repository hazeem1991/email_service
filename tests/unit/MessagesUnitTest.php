<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use \App\Http\Models\Message;

class MessagesUnitTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;


    public function testAddMessages()
    {
        $message = factory(Message::class)->create();
        $this->seeInDatabase('messages', ['id' => $message->id]);
    }
}
