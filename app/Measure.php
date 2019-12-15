<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    public function metrics(){
        return $this->hasMany('App\Metric', 'measure', 'id');
    }
}
