<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCardMeasure extends Model
{
    public function metrics(){
        return $this->hasMany('App\ScoreCardMetric', 'measure', 'id')->orderBy('id', 'asc');
    }

    public function actual(){
        return $this->hasOne('App\Measure', 'id', 'measure');
    }
}
