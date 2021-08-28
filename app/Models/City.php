<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function ad()
    {
        return $this->hasOne(Ad::class, 'city_id');
    }
}
