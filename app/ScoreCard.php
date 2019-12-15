<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    public function staff(){
        return $this->hasOne('App\Staff', 'id', 'staff' );
    }

    public function objectives(){
        return $this->hasMany('App\ScoreCardObjective', 'score_card', 'id');
    }
}
