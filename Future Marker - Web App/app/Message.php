<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Message extends Model
{
    public function fromUser()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo('App\User', 'to_user_id');
    }

    public function getOtherUserAttribute()
    {
        if ($this->attributes['from_user_id'] == Auth::id()) {
            return $this->toUser;
        } else {
            return $this->fromUser;
        }
    }
    public function getAttachmentFilesAttribute()
    {
        $msg_attachment_files = Storage::files($this->attributes['attachments_dir']);
        $msg_attachments_arr = array();
        foreach ($msg_attachment_files as $att) {
            $msg_attachments_arr[basename($att)] = "/".$att;
        }
        return $msg_attachments_arr;
    }
}
