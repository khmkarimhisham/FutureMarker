<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

    protected $with = ['user', 'comments', 'course', 'likes'];

    public function getPostAttachmentFilesAttribute()
    {

        if ($this->attributes['post_attachment'] != null) {
            $post_attachment_files = Storage::files($this->attributes['post_attachment']);
            $post_attachments_arr = array();
            foreach ($post_attachment_files as $att) {
                $post_attachments_arr[basename($att)] = $att;
            }
            return $post_attachments_arr;
        }
        return array();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
