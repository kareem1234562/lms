<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizLesson extends Model
{
    protected $guarded = [];
    public function lesson(){
        return $this->belongsTo(New_Lessons::class,'lesson_id');
    }
    public function questions(){
        return $this->hasMany(QuestionLesson::class,'lesson_id');
    }
    use HasFactory;
}
