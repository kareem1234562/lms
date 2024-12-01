<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewInstructors extends Model
{
    protected $guarded = [];
    public function Courses(){
        return $this->belongsToMany(NewCourses::class, 'new_instructors_new_courses', 'new_instructors_id', 'new_courses_id');
    }
    use HasFactory;
}
