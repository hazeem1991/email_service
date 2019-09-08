<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProviderAccount extends Model
{
    protected $table = "email_provider_accounts";
    protected $fillable = ["status", "type", "username", "password", "priority"];
    public function getUsernameAttribute($value)
    {
        return base64_encode(Str::random(10)).base64_encode($value).base64_encode(Str::random(10));
    }
    public function getPasswordAttribute($value)
    {
        return base64_encode(Str::random(10)).base64_encode($value).base64_encode(Str::random(10));
    }
}