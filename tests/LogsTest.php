<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LogsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListLogs()
    {
        $response = $this->get('/log', ['accept' => 'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }
}