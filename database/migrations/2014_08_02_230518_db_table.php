<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schemaName = config("database.connections.mysql.database");
        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');

        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";
//        \DB::raw($query);
        config(["database.connections.mysql.database" => $schemaName]);
    }
}