<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable=['type','body','recipients','subject','sender'];
}