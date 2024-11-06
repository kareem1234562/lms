<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class CoursesSections extends Model
{
    //
    protected $guarded = [];
    public function photoLink() {
        $link = '';
        if ($this->photo != '') {
            if (File::exists('uploads/coursesSection/'.$this->id.'/'.$this->photo)){
                $link = asset('uploads/coursesSection/'.$this->id.'/'.$this->photo);
            }
        }
        return $link;
    }
}
