<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    Use Notifiable;
    //overwriting default table
    protected $table = 'staff';

    protected $fillable = [
        'name', 'email', 'password', 'google_id'
    ];
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->hasOne('App\Role', 'id', 'role' );
    }

    public function department(){
        return $this->hasOne('App\Department', 'id', 'department' );
    }


}
