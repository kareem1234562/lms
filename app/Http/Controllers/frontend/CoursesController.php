<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\CourseLessons;
use App\Models\CourseSections;
use App\Models\CoursesSections;
use Response;

class CoursesController extends Controller
{
    //
    public function index()
    {
        $sections = CoursesSections::orderBy('name_'.session()->get('Lang'),'asc')->pluck('name_'.session()->get('Lang'),'id')->all();
        $Courses = Courses::where('is_course',1);
        if (isset($_GET['section_id'])) {
            if ($_GET['section_id'] != '') {
                $Courses = $Courses->where('section_id',$_GET['section_id']);
            }
        }
        $Courses = $Courses->orderBy('id','desc')->paginate(12);
        return view('FrontEnd.courses.index',[
            'courses' => $Courses,
            'sections' => $sections
        ]);
    }
    public function details($id)
    {
        $details = Courses::find($id);
        $lessons = CourseLessons::where('course_id',$id)->where('section_id',0)->orderBy('the_order','asc')->get();
        $sections = CourseSections::where('course_id',$id)->orderBy('the_order','asc')->get();
        $Courses = Courses::orderBy('id','desc')->paginate(12);
        return view('FrontEnd.courses.details',[
            'courses' => $Courses,
            'details' => $details,
            'lessons' => $lessons,
            'sections' => $sections,
            'active' => 'course'
        ]);
    }
    public function lesson($course_id,$lesson_id)
    {
        $details = Courses::find($course_id);
        $lesson_details = CourseLessons::find($lesson_id);
        $lessons = CourseLessons::where('course_id',$course_id)->where('section_id',0)->orderBy('the_order','asc')->get();
        $sections = CourseSections::where('course_id',$course_id)->orderBy('the_order','asc')->get();
        $Courses = Courses::orderBy('id','desc')->paginate(12);
        return view('FrontEnd.courses.lesson',[
            'courses' => $Courses,
            'details' => $details,
            'lessons' => $lessons,
            'lesson_details' => $lesson_details,
            'sections' => $sections,
            'active' => 'course'
        ]);
    }
}
