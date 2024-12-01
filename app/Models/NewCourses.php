<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCourses extends Model
{
    protected $guarded = [];
    public function Instructors_course(){
        return $this->belongsToMany(NewInstructors::class, 'new_instructors_new_courses', 'new_courses_id','new_instructors_id');


    }
    public function chapters(){
    return $this->hasMany(Chapters::class,'course_id');
    }
    public function Lessons_course(){
        return $this->hasMany(New_Lessons::class,'course_id');
    }
    public function quizes(){
        return $this->hasMany(QuizCourse::class,'course_id');
    }
    use HasFactory;
}
