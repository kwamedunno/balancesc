<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    //overwriting default table
    protected $table = 'staff';

    public function role(){
        return $this->hasOne('App\Role', 'id', 'role' );
    }

    public function department(){
        return $this->hasOne('App\Department', 'id', 'department' );
    }


}
