<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructors;
use Response;

class InstructorsController extends Controller
{

    public function index()
    {
        $instructors = Instructors::orderBy('name_ar','desc')->paginate(25);
        return view('AdminPanel.instructors.index',[
            'active' => 'courses',
            'title' => trans('learning.instructors'),
            'instructors' => $instructors,
            'breadcrumbs' => [
                [
                    'url' => route('admin.courses'),
                    'text' => 'الدورات التدريبية'
                ],
                [
                    'url' => '',
                    'text' => trans('learning.instructors')
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token','photo']);
        $section = Instructors::create($data);
        if ($section) {
            if ($request->hasFile('photo') != '') {
                $data['photo'] = upload_image_without_resize('instructors/'.$section->id , $request->photo );
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
        $section = Instructors::find($sectionId);
        $update = Instructors::find($sectionId)->update($data);
        if ($update) {
            if ($request->photo != '') {
                if ($section->photo != '') {
                    delete_image('instructors/'.$sectionId , $section->photo);
                }
                $data['photo'] = upload_image_without_resize('instructors/'.$sectionId , $request->photo );
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
        $course = Instructors::find($sectionId);
        if ($course->delete()) {
            delete_folder('uploads/instructors/'.$sectionId);
            return Response::json($sectionId);
        }
        return Response::json("false");
    }
}
