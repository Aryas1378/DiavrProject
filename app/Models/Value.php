<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    public function get_value()
    {
        return $this->hasOne(AttributeValue::class);
    }
}
