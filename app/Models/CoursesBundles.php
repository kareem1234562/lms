<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesBundles extends Model
{
    //
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(CoursesBundlesItems::class, 'bundle_id');
    }
}
