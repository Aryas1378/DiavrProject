<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
