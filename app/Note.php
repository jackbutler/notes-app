<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ["title","content"];
    protected $dates = ["created_at","updated_at"];

    // Define the one to many relationship with comments
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    // Define the many to one relationship with users
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
