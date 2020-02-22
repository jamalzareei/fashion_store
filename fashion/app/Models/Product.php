<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    //
    use Sluggable;

    protected $guarded = [];

    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
    
    public function image()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function seller()
    {
        return $this->belongsTo('App\Models\Seller');
    }
}
