<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = "logs";
    protected $fillable = ["sender", "recipients", "rawResponse", "provider", "status", "message"];
}