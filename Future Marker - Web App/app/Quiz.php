<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function quizQuestions()
    {
        return $this->hasMany('App\QuizQuestion');
    }

    public function finishedQuizzes()
    {
        return $this->hasMany('App\FinishedQuiz');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
