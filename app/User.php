<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


    // Define the one to many relationship with notes
    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
