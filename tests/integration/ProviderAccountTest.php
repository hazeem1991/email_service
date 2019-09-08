<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProviderAccountTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListProviderAccount()
    {
        $response = $this->get('/provider_account', ['accept' => 'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }

    public function testAddProviderAccount()
    {
        $response = $this->get('/provider_account/add', ['accept' => 'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
        $response = $this->post('/provider_account/add', ['test' => "422 error"], ['accept' => 'application/json']);

        $this->assertEquals(422, $this->response->status());
        $response = $this->post('/provider_account/add',
            [
                'type' => "Sendgrid",
                'username' => 'test',
                'password' => 'test',
                'priority' => rand(0, 20),
                'status' => 1
            ], ['accept' => 'application/json']);
        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }

    public function testEditProviderAccount()
    {
        $response = $this->get('/provider_account/edit', ['accept' => 'application/json']);
        $this->assertEquals(404, $this->response->status());
        $response = $this->post('/provider_account/add',
            [
                'type' => "Sendgrid",
                'username' => 'test',
                'password' => 'test',
                'priority' => rand(0, 20),
                'status' => 1
            ], ['accept' => 'application/json']);
        $response = $this->get('/provider_account/edit/1', ['accept' => 'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);

        $response = $this->put('/provider_account/edit/1', ['test' => "422 error"], ['accept' => 'application/json']);
        $this->assertEquals(422, $this->response->status());
        $response = $this->put('/provider_account/edit/1',
            [
                'type' => "Sendgrid",
                'username' => 'test',
                'password' => 'test',
                'priority' => rand(0, 20),
                'status' => 1
            ], ['accept' => 'application/json']);
        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }

    public function testDeleteProviderAccount()
    {
        $response = $this->get('/provider_account/delete', ['accept' => 'application/json']);
        $this->assertEquals(404, $this->response->status());
        $response = $this->post('/provider_account/add',
            [
                'type' => "Sendgrid",
                'username' => 'test',
                'password' => 'test',
                'priority' => rand(0, 20),
                'status' => 1
            ], ['accept' => 'application/json']);
        $response = $this->delete('/provider_account/delete/1', ['accept' => 'application/json']);

        $this->assertEquals(200, $this->response->status());
        $response->seeJson([
            'code' => '00',
        ]);
    }
}