<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'city_id',
        'category_id',
        'status_id',
        'status_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'ad_attributes')->withPivot('value');
    }

    public function status()
    {
        return $this->belongsTo(StatusValue::class, 'status_id');
    }

}
