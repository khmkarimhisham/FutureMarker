<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicTest extends Model
{

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }
}
