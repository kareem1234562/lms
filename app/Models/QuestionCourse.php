<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCourse extends Model
{
    protected $guarded=[];
    public function quiz(){
        return $this->belongsTo(QuizCourse::class,'quiz_id');
    }
    use HasFactory;
}
