<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSeperate extends Model
{
    protected $guarded=[];
    public function seperate_quiz(){
        return $this->belongsTo(SeperateQuiz::class,'seperate_id');
    }
    use HasFactory;
}
