<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeperateQuiz extends Model
{
    protected $guarded=[];

    public function questions(){
        return $this->hasMany(QuestionSeperate::class,'seperate_id');
    }
    use HasFactory;
}
