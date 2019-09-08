<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProviderAccount extends Model
{
    protected $table = "email_provider_accounts";
    protected $fillable = ["status", "type", "username", "password", "priority"];

    /**
     * For mask the user name before displaying it
     * @param $value string user name
     * @return  string
     */
    public function getUsernameAttribute(string $value): string
    {
        return base64_encode(Str::random(10)) . base64_encode($value) . base64_encode(Str::random(10));
    }

    /**
     * For mask the password before displaying it
     * @param $value string password
     * @return  string
     */
    public function getPasswordAttribute(string $value): string
    {
        return base64_encode(Str::random(10)) . base64_encode($value) . base64_encode(Str::random(10));
    }
}