<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Colleges;
use App\Models\Univerisities;
use App\Models\Countries;
use Response;

class CurriculumsController extends Controller
{
    //
    public function index($country_id,$university_id, $college_id)
    {
        $country = Countries::find($country_id);
        $univerisity = Univerisities::find($university_id);
        $college = Colleges::find($college_id);
        $courses = Courses::where('is_course','!=',1)->where('college_id',$college_id)->orderBy('name','desc')->paginate(25);
        return view('AdminPanel.courses.index',[
            'active' => 'curriculums',
            'title' => trans('learning.curriculums'),
            'country' => $country,
            'univerisity' => $univerisity,
            'college' => $college,
            'courses' => $courses,
            'breadcrumbs' => [
                [
                    'url' => route('admin.countries.index'),
                    'text' => trans('common.countries')
                ],
                [
                    'url' => route('admin.univerisities',$country->id),
                    'text' => trans('learning.univerisities').' في '.$country['name_'.session()->get('Lang')]
                ],
                [
                    'url' => route('admin.colleges',['countryId'=>$country_id,'UniId'=>$university_id]),
                    'text' => trans('learning.colleges').' في '.$univerisity['name_'.session()->get('Lang')]
                ],
                [
                    'url' => '',
                    'text' => trans('learning.curriculums').' في '.$college['name_'.session()->get('Lang')]
                ]
            ]
        ]);
    }
}
