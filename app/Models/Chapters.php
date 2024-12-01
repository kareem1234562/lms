<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    protected $guarded = [];
    public function course_chapter(){
        return $this->belongsTo(NewCourses::class,'course_id');
    }
    public function lessons_chapter(){
        return $this->hasMany(New_Lessons::class,'chapter_id');
    }
    use HasFactory;
}
