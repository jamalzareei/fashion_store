<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    //
    protected $fillable = [
        'username', 'token', 'password'
    ];
}
