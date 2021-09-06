<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeDefaultValue extends Model
{
    use HasFactory;
    protected $fillable =[
        'attribute_id',
        'values',
    ];
}
