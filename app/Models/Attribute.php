<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function attributes()
    {
        return $this->hasMany(AttributeCategory::class, 'attribute_id');
    }

}
