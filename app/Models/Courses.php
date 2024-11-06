<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Courses extends Model
{
    //
    protected $guarded = [];
    public function groups()
    {
        return $this->hasMany(CourseGroups::class,'course_id');
    }
    public function clients()
    {
        return $this->hasMany(CourseGroupClients::class,'course_id');
    }
    public function revenues()
    {
        return $this->hasMany(Revenues::class,'course_id');
    }
    public function instructor()
    {
        return $this->hasOne(User::class,'id','instructor_id');
    }
    public function instructor_ids()
    {
        return explode( ',', $this->instructor_id );
    }
    public function section()
    {
        return $this->belongsTo(CoursesSections::class,'section_id');
    }
    public function sections()
    {
        return $this->hasMany(CourseSections::class,'course_id');
    }
    public function sectionsList()
    {
        $sections = [];
        foreach ($this->sections as $key => $value) {
            $sections[$value['id']] = $value['name_ar'];
        }
        return $sections;
    }
    public function college()
    {
        return $this->belongsTo(Colleges::class,'college_id');
    }
    public function Univerisity()
    {
        return $this->belongsTo(Univerisities::class,'university_id');
    }
    public function country()
    {
        return $this->belongsTo(Countries::class,'country_id');
    }
    public function totals($month = null, $year = null)
    {
        return [
            'clients' => 0,
            'starting_groups' => 0,
            'ending_group' => 0,
            'revenues' => 0
        ];
    }
    public function canDelete()
    {
        $status = true;
        // if ($this->groups()->count() > 0) {
        //     $status = false;
        // }
        // if ($this->clients()->count() > 0) {
        //     $status = false;
        // }
        // if ($this->revenues()->count() > 0) {
        //     $status = false;
        // }
        return $status;
    }
    public function photoLink() {
        $link = asset('FrontendAssets/assets/images/courses/courses-img10.jpg');
        if ($this->photo != '') {
            if (File::exists('uploads/courses/'.$this->id.'/'.$this->photo)){
                $link = asset('uploads/courses/'.$this->id.'/'.$this->photo);
            }
        }
        return $link;
    }
    public function sharingPhotoLink() {
        $link = '';
        if ($this->sharing_photo != '') {
            if (File::exists('uploads/courses/'.$this->id.'/'.$this->sharing_photo)){
                $link = asset('uploads/courses/'.$this->id.'/'.$this->sharing_photo);
            }
        }
        return $link;
    }
}
