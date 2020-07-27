<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishedQuiz extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
