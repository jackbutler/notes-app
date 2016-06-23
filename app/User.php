<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ["first_name","last_name","email","password"];
    protected $dates = ["created_at","updated_at"];


    /**
     * Define the one to many relationship from users to notes
     *
     * @return mixed
     */
    public function notes()
    {
        return $this->hasMany('App\Note');
    }


    /**
     * Concatenate the first and last names to form a full name string
     *
     * @return string
     */
    public function name()
    {
        return $this->first_name." ".$this->last_name;
    }

    /**
     * Generate an absolute URL to the user's profile picture
     *
     * @return mixed
     */
    public function profilePictureUrl() {
        return url("uploads/".$this->profile_picture);
    }
}
