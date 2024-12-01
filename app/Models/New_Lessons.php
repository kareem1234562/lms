<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_Lessons extends Model
{
    protected $guarded = [];
    public function course(){
        return $this->belongsTo(NewCourses::class,'course_id');
    }
    public function chapter(){
        return $this->belongsTo(Chapters::class,'chapter_id');
    }
    public function quizes(){
        return $this->hasOne(QuizLesson::class,'lesson_id');
    }
    use HasFactory;
}
