<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursesSections;
use App\Models\Courses;
use App\Models\CourseGroupClients;
use App\Models\Clients;
use Response;


class CoursesSectionsController extends Controller
{
    public function index()
    {
        $CoursesSections = CoursesSections::orderBy('name_ar','desc')->paginate(25);
        return view('AdminPanel.coursesSections.index',[
            'active' => 'courses',
            'title' => 'أقسام الدورات التدريبية',
            'sections' => $CoursesSections,
            'breadcrumbs' => [
                [
                    'url' => route('admin.courses'),
                    'text' => 'الدورات التدريبية'
                ],
                [
                    'url' => '',
                    'text' => 'أقسام الدورات التدريبية'
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token','photo']);
        $section = CoursesSections::create($data);
        if ($section) {
            if ($request->hasFile('photo') != '') {
                $data['photo'] = upload_image_without_resize('coursesSection/'.$section->id , $request->photo );
                $section->update($data);
            }

            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $sectionId)
    {
        $data = $request->except(['_token','photo']);
        $section = CoursesSections::find($sectionId);
        $update = CoursesSections::find($sectionId)->update($data);
        if ($update) {
            if ($request->photo != '') {
                if ($section->photo != '') {
                    delete_image('coursesSection/'.$sectionId , $section->photo);
                }
                $data['photo'] = upload_image_without_resize('coursesSection/'.$sectionId , $request->photo );
                $section->update($data);
            }
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($sectionId)
    {
        $course = CoursesSections::find($sectionId);
        if ($course->delete()) {
            delete_folder('uploads/coursesSection/'.$sectionId);
            return Response::json($sectionId);
        }
        return Response::json("false");
    }
}
