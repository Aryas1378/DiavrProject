<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'ad_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}
