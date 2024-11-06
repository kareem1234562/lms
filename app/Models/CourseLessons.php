<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class CourseLessons extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function checkUserCanWatch() {
        $html = '';
        $can_watch = 0;
        if ($this->checkUser() == 1) {
            $html .='<a class="btn btn-icon btn-success" href="';
            $html .= route( 'website.courses.lesson', [$this->course_id, $this->id] );
            $html .='">';
            $html .='<i class="ri-lock-unlock-line text-white"></i>';
            $html .='</a>';
        }
        return $html;
    }

    public function checkUser() {
        $can_watch = 0;
        if (auth()->check()) {
            $check_user_course = auth()->user()->studentCourses()->where('course_id',$this->course_id)->first();
            if ($check_user_course != '') {
                if ($this->price > 0) {
                    $check_user_course = auth()->user()->studentLessons()->where('lesson_id',$this->id)->first();
                    if ($check_user_course) {
                        $can_watch = 1;
                    }
                } else {
                    $can_watch = 1;
                }
            }
        }
        return $can_watch;
    }
    public function checkUserCanWatchInList() {
        $html = '<i class="fa fa-fw fa-clock-o"></i>';
        // return $html;
    }
    public function section() {
        return $this->belongsTo(CourseSections::class, 'section_id');
    }
    public function getNumber() {
        return $this->the_order;
    }
    public function getVideoLink() {
        $link = '';
        if ($this->video_cdn != '') {
            return $this->video_cdn;
        }
        if ($this->video != '') {
            if (File::exists('uploads/courses/'.$this->course_id.'/lessons/'.$this->id.'/'.$this->video)){
                $link = asset('uploads/courses/'.$this->course_id.'/lessons/'.$this->id.'/'.$this->video);
            }
        }
        return $link;
    }
    public function getVideoLinkPublic() {
        $link = '';
        if ($this->video != '') {
            if (File::exists('uploads/courses/'.$this->course_id.'/lessons/'.$this->id.'/'.$this->video)){
                $link = public_path('uploads/courses/'.$this->course_id.'/lessons/'.$this->id.'/'.$this->video);
            }
        }
        return $link;
    }
    public function getFileLink() {
        $link = '';
        if ($this->file != '') {
            if (File::exists('uploads/courses/'.$this->course_id.'/lessons/'.$this->id.'/'.$this->file)){
                $link = asset('uploads/courses/'.$this->course_id.'/lessons/'.$this->id.'/'.$this->file);
            }
        }
        return $link;
    }
}
