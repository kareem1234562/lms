<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseGroups;
use App\Models\CourseGroupTimes;
use App\Models\Courses;
use Response;

class GroupsController extends Controller
{
    public function index($course_id)
    {
        $course = Courses::find($course_id);
        $groups = $course->groups()->orderBy('id','desc')->paginate(25);
        return view('AdminPanel.courses.groups.index',[
            'active' => 'courses',
            'title' => $course->name.': المجموعات',
            'course' => $course,
            'groups' => $groups,
            'breadcrumbs' => [
                [
                    'url' => route('admin.courses'),
                    'text' => 'الدورات التدريبية'
                ],
                [
                    'url' => '',
                    'text' => $course->name
                ],
                [
                    'url' => '',
                    'text' => 'المجموعات'
                ]
            ]
        ]);
    }

    public function store($course_id,Request $request)
    {
        $data = $request->except(['_token','day','time_from','time_to']);
        $data['course_id'] = $course_id;
        $group = CourseGroups::create($data);
        for ($i=0; $i < count($request->day); $i++) {
            $day_data = [
                'course_id' => $course_id,
                'group_id' => $group->id,
                'day' => $request['day'][$i],
                'time_from' => $request['time_from'][$i],
                'time_to' => $request['time_to'][$i]
            ];
            $day = CourseGroupTimes::create($day_data);
        }
        if ($group) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update($course_id,Request $request, $groupId)
    {
        $data = $request->except(['_token','day','time_from','time_to']);
        $update = CourseGroups::find($groupId)->update($data);
        $delete_old_times = CourseGroups::find($groupId)->times()->delete();
        if ($request->day) {
            for ($i=0; $i < count($request->day); $i++) {
                $day_data = [
                    'course_id' => $course_id,
                    'group_id' => $groupId,
                    'day' => $request['day'][$i],
                    'time_from' => $request['time_from'][$i],
                    'time_to' => $request['time_to'][$i]
                ];
                $day = CourseGroupTimes::create($day_data);
            }
        }

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
