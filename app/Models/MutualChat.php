<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutualChat extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'sender_id',
        'receiver_id',
        'ad_id',
        'chat_starter',

    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

}
