<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Seller extends Model
{
    //
    use Sluggable;
    use SoftDeletes;

    protected $guarded = [];

    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable')->where('default_use', 'GALLERY');
    }
    public function image()
    {
        return $this->morphMany('App\Models\Image', 'imageable')->where('default_use', 'MAIN');
    }
    
    public function sosials()
    {
        return $this->belongsToMany('App\Models\Sosial');
    }

    public function sosialSeller()
    {
        return $this->hasMany('App\Models\SosialSeller');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
