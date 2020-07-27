<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureTest extends Model
{

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

}
