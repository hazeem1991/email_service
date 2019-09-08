<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Models\Log;

class LogsUnitTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogsModel()
    {
        $log=factory(Log::class)->create(['provider'=>1]);
        $this->seeInDatabase('logs', ['id' => $log->id]);
    }
}