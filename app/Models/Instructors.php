<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Instructors extends Model
{
    //
    protected $guarded = [];
    public function photoLink() {
        $link = '';
        if ($this->photo != '') {
            if (File::exists('uploads/instructors/'.$this->id.'/'.$this->photo)){
                $link = asset('uploads/instructors/'.$this->id.'/'.$this->photo);
            }
        }
        return $link;
    }
    public function courses() {
        return $this->hasMany(Courses::class,'instructor_id');
    }
    public function studentsCount() {
        $count = 0;
        foreach ($this->courses as $key => $value) {
            $count += $value->clients()->count();
        }
        return $count;
    }
}
