<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCourse extends Model
{
    protected $guarded=[];
    public function course(){
        return $this->belongsTo(NewCourses::class,'course_id');
    }
    public function questions(){
        return $this->hasMany(QuestionCourse::class,'quiz_id');
    }
    use HasFactory;
}
