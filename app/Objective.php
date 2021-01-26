<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    public function objectives(){
        return $this->hasMany('App\Objective', 'parent', 'id');
    }

    public function measures(){
        return $this->hasMany('App\Measure', 'objective', 'id');
    }
}
