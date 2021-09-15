<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
    ];

    public function channel()
    {
       return $this->belongsTo(Channel::class, 'ad_id');
    }

}
