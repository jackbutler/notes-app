<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    // Define the one to many relationship with comments
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // Define the many to one relationship with users
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
