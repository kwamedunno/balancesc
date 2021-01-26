<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCardObjective extends Model
{
    
    public function measures(){
        return $this->hasMany('App\ScoreCardMeasure', 'objective', 'id');
    }

    public function actual(){
        return $this->hasOne('App\Objective', 'id', 'objective');
    }

    public function objectives(){
        return $this->hasMany('App\ScoreCardObjective', 'parent', 'id');
    }

}