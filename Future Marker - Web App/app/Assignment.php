<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Assignment extends Model
{
    protected $with = ['course'];
    public function getAttachmentsAttribute()
    {
        if ($this->attributes['attachments_dir'] != null) {
            $attachment_files = Storage::files($this->attributes['attachments_dir']);
            $attachments_arr = array();
            foreach ($attachment_files as $att) {
                $attachments_arr[basename($att)] = "/" . $att;
            }
            return $attachments_arr;
        }
        return array();
    }
    public function getAssignmentDescAttribute()
    {
        return Storage::get($this->attributes['assignment_desc_dir']);
    }

    public function featureTests()
    {
        return $this->hasMany('App\FeatureTest');
    }

    public function dynamicTests()
    {
        return $this->hasMany('App\DynamicTest');
    }

    public function finishedAssignments()
    {
        return $this->hasMany('App\FinishedAssignment');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

}
