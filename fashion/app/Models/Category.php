<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
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

    
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id', 'id' );
    }

    public function image()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
