<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCard extends Model
{
    public function staff(){
        return $this->hasOne('App\Staff', 'id', 'staff');
    }

    public function objectives(){
        return $this->hasMany('App\ScoreCardObjective', 'score_card', 'id');
    }

    public function lastUpdatedBy(){
        return $this->hasOne('App\Staff','id','last_updated_by');
    }

    public function comments(){
        return $this->hasMany('App\Comment','score_card','id');
    }
}

