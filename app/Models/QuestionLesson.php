<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionLesson extends Model
{
    protected $guarded=[];
    public function lesson(){
        return $this->belongsTo(QuizLesson::class,'lesson_id');
    }
    use HasFactory;
}
