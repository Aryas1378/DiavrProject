<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    const accepted = 2;


    protected $fillable = [
        'title',
        'description',
        'city_id',
        'user_id',
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

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'ad_id');
    }

    public function channels()
    {
        return $this->hasMany(Channel::class, 'ad_id');
    }

    public function mutualChats()
    {
        return $this->hasMany(MutualChat::class, 'ad_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
