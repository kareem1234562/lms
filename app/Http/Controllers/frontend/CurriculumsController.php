<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\CourseLessons;
use App\Models\CourseSections;
use App\Models\Countries;
use App\Models\Univerisities;
use App\Models\Colleges;
use Response;

class CurriculumsController extends Controller
{
    //
    public function index()
    {
        $curriculums = [];
        $Univerisities = [];
        $Colleges = [];
        if (isset($_GET['country_id']) || isset($_GET['university_id']) || isset($_GET['college_id'])) {
            $curriculums = Courses::where('is_course',0);
            if (isset($_GET['country_id'])) {
                if ($_GET['country_id'] != '') {
                    $curriculums = $curriculums->where('country_id',$_GET['country_id']);
                    $Univerisities = Univerisities::where('country_id',$_GET['country_id'])->pluck('name_'.session()->get('Lang'),'id')->all();
                }
            }
            if (isset($_GET['university_id'])) {
                if ($_GET['university_id'] != '') {
                    $curriculums = $curriculums->where('university_id',$_GET['university_id']);
                    $Colleges = Colleges::where('university_id',$_GET['university_id'])->pluck('name_'.session()->get('Lang'),'id')->all();
                }
            }
            if (isset($_GET['college_id'])) {
                if ($_GET['college_id'] != '') {
                    $curriculums = $curriculums->where('college_id',$_GET['college_id']);
                }
            }
            $curriculums = $curriculums->orderBy('id','desc')->paginate(12);
        }
        $countries = Countries::orderBy('name_'.session()->get('Lang'))->pluck('name_'.session()->get('Lang'),'id')->all();
        return view('FrontEnd.curriculums.index',[
            'curriculums' => $curriculums,
            'countries' => $countries,
            'Univerisities' => $Univerisities,
            'Colleges' => $Colleges
        ]);
    }

    public function details($id)
    {
        $details = Courses::find($id);
        $lessons = CourseLessons::where('course_id',$id)->where('section_id',0)->orderBy('the_order','asc')->get();
        $sections = CourseSections::where('course_id',$id)->orderBy('the_order','asc')->get();
        $Courses = Courses::orderBy('id','desc')->paginate(12);
        return view('FrontEnd.curriculums.details',[
            'courses' => $Courses,
            'details' => $details,
            'lessons' => $lessons,
            'sections' => $sections,
            'active' => 'course'
        ]);
    }

    public function GetUniversityList()
    {

        $list = [];
        if (isset($_GET['get'])) {
            if ($_GET['get'] == 'University') {
                $Univerisities = Univerisities::where('country_id',$_GET['id'])->get();
                foreach ($Univerisities as $key => $value) {
                    $list[] = [
                        'id' => $value->id,
                        'name' => $value['name_'.session()->get('Lang')]
                    ];
                }
            } else {
                $Colleges = Colleges::where('university_id',$_GET['id'])->get();
                foreach ($Colleges as $key => $value) {
                    $list[] = [
                        'id' => $value->id,
                        'name' => $value['name_'.session()->get('Lang')]
                    ];
                }
            }
        }
        return Response::json($list);
    }
}
