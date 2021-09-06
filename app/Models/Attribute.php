<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    Use HasFactory;
    protected $fillable =
        [
            'name'
        ];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'attribute_category');
    }

//    public function ads()
//    {
//        return $this->belongsToMany(Ad::class, 'attribute_value');
//    }

    public function defaultValues()
    {
        return $this->hasMany(AttributeDefaultValue::class, 'attribute_id');
    }

}
