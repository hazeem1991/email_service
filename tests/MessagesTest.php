<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MessagesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListMessages()
    {
        $response = $this->get( '/messages',['accept'=>'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
        $response = $this->get( '/messages/add',['accept'=>'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }
}
