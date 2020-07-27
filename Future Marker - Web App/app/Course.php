<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    

    public function getFoldersAttribute()
    {
        $dir = Storage::directories($this->attributes['course_material_dir']);
        $folders = array();
        foreach($dir as $folder){
            array_push($folders,basename($folder));
        }
        return $folders;
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }


    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }


    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
