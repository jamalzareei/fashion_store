<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ExtraField extends Model
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

    public function extrafieldsproduct()
    {
        return $this->hasMany('App\Models\ExtraFieldsProduct');
    }
}
