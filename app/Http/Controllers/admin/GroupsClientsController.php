<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseGroupClients;
use App\Models\CourseGroups;
use App\Models\Courses;
use Response;

class GroupsClientsController extends Controller
{
    public function index($course_id, $group_id)
    {
        $course = Courses::find($course_id);
        $group = CourseGroups::find($group_id);
        $reservations = $group->clients()->get();
        return view('AdminPanel.courses.groups.clients.index',[
            'active' => 'courses',
            'title' => $course->name.': طلاب المجموعة #'.$group_id,
            'course' => $course,
            'group' => $group,
            'reservations' => $reservations,
            'breadcrumbs' => [
                [
                    'url' => route('admin.courses'),
                    'text' => 'الدورات التدريبية'
                ],
                [
                    'url' => route('admin.courses.groups',$course_id),
                    'text' => $course->name
                ],
                [
                    'url' => '',
                    'text' => 'طلاب المجموعة #'.$group_id
                ]
            ]
        ]);
    }

    public function store($course_id,$group_id,Request $request)
    {
        $data = $request->except(['_token']);
        $group = CourseGroupClients::whereIn('id',$request->clients)->update(['group_id'=>$group_id]);
        if ($group) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update($course_id, $group_id, $group_client_id, Request $request)
    {
        $data = $request->except(['_token']);
        $update = CourseGroupClients::find($group_client_id)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($course_id,$groupId)
    {
        $group = CourseGroups::find($groupId);
        if ($group->delete()) {
            return Response::json($groupId);
        }
        return Response::json("false");
    }
}
