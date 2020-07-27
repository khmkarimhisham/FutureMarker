<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role' , 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function courses()
    {
       return $this->belongsToMany('App\Course');
    }

    public function notifications()
    {      
       return $this->hasMany('App\Notification')->orderBy('created_at', 'DESC');
    }

    public function finishedAssignments()
    {
        return $this->hasMany('App\FinishedAssignment');
    }


    public function finishedQuizzes()
    {
        return $this->hasMany('App\FinishedQuiz');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    public function sentMessages()
    {
        return $this->hasMany('App\Message', 'from_user_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany('App\Message', 'to_user_id');
    }


    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
