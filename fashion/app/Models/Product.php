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
    
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable')->where('default_use', 'GALLERY');
    }
    public function image()
    {
        return $this->morphMany('App\Models\Image', 'imageable')->where('default_use', 'MAIN');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function seller()
    {
        return $this->belongsTo('App\Models\Seller');
    }
    
    public function extrafields()
    {
        return $this->belongsToMany('App\Models\Extrafield');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }
    // public function extrafields()
    // {
    //     return $this->belongsToMany('App\Models\Extrafield', 'extra_field_product', 'product_id', 'extra_field_id');
    // }
}
