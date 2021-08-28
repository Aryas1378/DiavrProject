<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
