<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderAccount extends Model
{
    protected $table="email_provider_accounts";
    protected $fillable=['type','body','recipients','subject','sender'];
}