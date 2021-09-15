<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_id',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'channel_id');
    }

}
