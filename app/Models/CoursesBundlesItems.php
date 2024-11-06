<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesBundlesItems extends Model
{
    //
    protected $guarded = [];
    public function bundle()
    {
        return $this->belongsTo(CoursesBundles::class, 'bundle_id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
