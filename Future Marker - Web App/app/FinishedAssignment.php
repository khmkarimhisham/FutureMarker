<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FinishedAssignment extends Model
{
    public function getStyleFeedbackAttribute($value)
    {
        return explode("#|#|#|#", $value);

    }

    public function getAssginmentFilesAttribute()
    {
        if ($this->attributes['assignment_dir'] != null) {
            $files = Storage::files($this->attributes['assignment_dir']);
            $files_arr = array();
            foreach ($files as $file) {
                $files_arr[basename($file)] = $file;
            }
            return $files_arr;
        }
        return array();
    }

    public function getDynamicTestFeedbackAttribute($value)
    {
        return explode("#|#|#|#", $value);
    }

    public function getFeatureTestFeedbackAttribute($value)
    {
        return explode("#|#|#|#", $value);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }
}
