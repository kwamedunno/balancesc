<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreCardMetric extends Model
{
    public function actual(){
        return $this->hasOne('App\Metric', 'id', 'metric');
    }
}
