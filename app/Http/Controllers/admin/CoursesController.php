<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursesBundles;
use App\Models\Courses;
use App\Models\CourseGroupClients;
use App\Models\Clients;
use Response;


class CoursesController extends Controller
{
    public function index()
    {
        $courses = Courses::where('is_course',1)->orderBy('name','desc')->paginate(25);
        return view('AdminPanel.courses.index',[
            'active' => 'courses',
            'title' => 'الدورات التدريبية',
            'courses' => $courses,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'الدورات التدريبية'
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        if (!userCan('courses_create')) {
            return redirect()->route('admin.index')->with('faild','لا يمكنك إضافة دورة تدريبية حيث لا يوجد لديك صلاحية لذلك');
        }
        $data = $request->except(['_token','sharing_photo','photo','instructor_id']);
        if ($request['instructor_id'] != '') {
            if (is_array($request['instructor_id'])) {
                if (!empty($request['instructor_id'])) {
                    $data['instructor_id'] = implode(",", $request['instructor_id']);
                }
            }
        }
        $course = Courses::create($data);
        if ($course) {
            if ($request->hasFile('photo') != '') {
                $data['photo'] = upload_image_without_resize('courses/'.$course->id , $request->photo );
                $course->update($data);
            }
            if ($request->hasFile('sharing_photo') != '') {
                $data['sharing_photo'] = upload_image_without_resize('courses/'.$course->id , $request->sharing_photo );
                $course->update($data);
            }

            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $courseId)
    {
        $data = $request->except(['_token','sharing_photo','photo','instructor_id']);
        $data['instructor_id'] = '';
        if ($request['instructor_id'] != '') {
            if (is_array($request['instructor_id'])) {
                if (!empty($request['instructor_id'])) {
                    $data['instructor_id'] = implode(",", $request['instructor_id']);
                }
            }
        }
        $course = Courses::find($courseId);
        $update = Courses::find($courseId)->update($data);
        if ($update) {
            if ($request->photo != '') {
                if ($course->photo != '') {
                    delete_image('courses/'.$courseId , $course->photo);
                }
                $data['photo'] = upload_image_without_resize('courses/'.$courseId , $request->photo );
                $course->update($data);
            }
            if ($request->sharing_photo != '') {
                if ($course->sharing_photo != '') {
                    delete_image('courses/'.$courseId , $course->sharing_photo);
                }
                $data['sharing_photo'] = upload_image_without_resize('courses/'.$courseId , $request->sharing_photo );
                $course->update($data);
            }
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($courseId)
    {
        $course = Courses::find($courseId);
        if ($course->delete()) {
            return Response::json($courseId);
        }
        return Response::json("false");
    }

    public function getCoursesOrBundles()
    {
        if ($_GET['type'] == 'course') {
            $courses = Courses::orderBy('name','asc')->get();
        } else {
            $courses = CoursesBundles::orderBy('name','asc')->get();
        }
        $list = [];
        foreach ($courses as $key => $value) {
            $list[] = [
                'id' => $value['id'],
                'name' => $value['name']
            ];
        }

        return $list;
    }


    public function getGroupsSchedule()
    {
        $courses = Courses::get();
        $groups = [];
        foreach ($courses as $key => $course) {
            foreach ($course->groups as $group) {
                if ($group->status != 2) {
                    foreach ($group->thisMonthSessions() as $session) {
                        // $groups[] = $session['from']. ' - ' .$session['from'];
                        $groups[] = [
                            'id' => $group->id,
                            'url' => '',
                            'title' => $course->name.': #'.$group->id,
                            'start' => $session['from'],
                            'end' => $session['to'],
                            'allDay' => false,
                            'extendedProps' => [
                                'calendar' => 'course'.$course->id
                            ]
                        ];
                    }
                }
            }
        }
        return response()->json($groups);
    }
    public function new_reservation(Request $request)
    {
        if ($request->cellphone == '') {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
        $client = Clients::where('cellphone',$request->cellphone)->first();
        if ($client != '') {
            return redirect()->route('admin.add_only_reservation',['client_id'=>$client->id]);
        }
        return redirect()->route('admin.add_client_reservation')
                                ->with('cellphone',$request->cellphone);
    }

    public function add_client_reservation()
    {
        return view('AdminPanel.courses.reservations.add_client_reservation',[
            'active' => 'courses',
            'title' => 'حجز دورة تدريبية',
            'cellphone' => session()->get('cellphone'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'حجز دورة تدريبية'
                ]
            ]
        ]);
    }

    public function add_client_reservation_submit(Request $request)
    {
        $data = $request->except(['_token']);
        $client = Clients::create([
            'Name' => $data['name'],
            'cellphone' => $data['cellphone'],
            'address' => $data['address']
        ]);
        if ($data['theType'] == 'course') {
            $course_details = Courses::find($data['course_id']);
            $the_price = $course_details['price'];
            if ($data['attendance'] == 'private') {
                $the_price = $course_details['private_price'] > 0 ? $course_details['private_price'] : $course_details['price'];
            } elseif ($data['attendance'] == 'online') {
                $the_price = $course_details['online_price'] > 0 ? $course_details['online_price'] : $course_details['price'];
            }

            $course_reservation = CourseGroupClients::create([
                'course_id' => $data['course_id'],
                'course_reservation_type' => $data['theType'],
                'group_id' => 0,
                'client_id' => $client['id'],
                'oreginal_price' => $course_details['price'],
                'reservation_price' => $the_price,
                'agent_id' => $data['agent_id']
            ]);
        } else {
            $bundle = CoursesBundles::find($data['course_id']);
            if ($bundle == '') {
                return redirect()->back()
                                ->with('faild','لقد قمت بحجز مجموعة تدريبية غير متاحه يرجى مراجعة البيانات مره أخرى');
            }
            foreach ($bundle->items as $key => $value) {
                $course_details = Courses::find($value['course_id']);
                $course_reservation = CourseGroupClients::create([
                    'course_id' => $value['course_id'],
                    'course_reservation_type' => $data['theType'],
                    'group_id' => 0,
                    'client_id' => $client['id'],
                    'oreginal_price' => $value['original_price'],
                    'reservation_price' => $value['bundle_price'],
                    'agent_id' => $data['agent_id']
                ]);
            }
        }

        if ($course_reservation) {
            return redirect()->route('admin.index')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function add_only_reservation($client_id)
    {
        $client = Clients::find($client_id);
        return view('AdminPanel.courses.reservations.add_only_reservation',[
            'active' => 'courses',
            'title' => 'حجز دورة تدريبية',
            'client' => $client,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'حجز دورة تدريبية'
                ]
            ]
        ]);
    }

    public function add_only_reservation_submit(Request $request)
    {
        $data = $request->except(['_token']);
        $client = Clients::find($data['client_id']);
        if ($data['theType'] == 'course') {
            $course_details = Courses::find($data['course_id']);
            if ($client->hasThisCourse($data['course_id']) == 1) {
                return redirect()->back()
                                ->with('faild','لقد قمت بحجز هذه الدورة التدريبية لنفس العميل سابقاً يرجى مراجعة البيانات مره أخرى');
            }
            $the_price = $course_details['price'];
            if ($data['attendance'] == 'private') {
                $the_price = $course_details['private_price'] > 0 ? $course_details['private_price'] : $course_details['price'];
            } elseif ($data['attendance'] == 'online') {
                $the_price = $course_details['online_price'] > 0 ? $course_details['online_price'] : $course_details['price'];
            }

            $course_reservation = CourseGroupClients::create([
                'course_id' => $data['course_id'],
                'course_reservation_type' => $data['theType'],
                'group_id' => 0,
                'client_id' => $client['id'],
                'oreginal_price' => $course_details['price'],
                'reservation_price' => $the_price,
                'agent_id' => $data['agent_id']
            ]);
        } else {
            # code...
        }

        if ($course_reservation) {
            return redirect()->route('admin.index')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }


    public function schedule()
    {
        return view('AdminPanel.courses.schedule',[
            'active' => 'courses',
            'title' => 'الجدول التدريبي',
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'الجدول التدريبي'
                ]
            ]
        ]);
    }
}
