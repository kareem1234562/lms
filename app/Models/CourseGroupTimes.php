<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseGroupTimes extends Model
{
    //
    protected $guarded = [];
    public function course() {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    public function group() {
        return $this->belongsTo(CourseGroups::class, 'group_id');
    }
}
