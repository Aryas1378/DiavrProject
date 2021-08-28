<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AttributeCategory extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attribute_category()
    {
        return $this->hasOne(AttributeValue::class, 'attribute_category_id');
    }
}
