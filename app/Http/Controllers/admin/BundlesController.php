<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursesBundlesItems;
use App\Models\CoursesBundles;
use App\Models\Courses;
use App\Models\Clients;
use Response;

class BundlesController extends Controller
{
    public function index()
    {
        $bundles = CoursesBundles::orderBy('name','desc')->paginate(25);
        return view('AdminPanel.courses.bundles.index',[
            'active' => 'courses_bundles',
            'title' => 'الدورات التدريبية المجمعة',
            'bundles' => $bundles,
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
        $data = $request->except(['_token','course_price','course_id']);
        // return $data;
        $courses = [];
        $totalCourses = 0;
        for ($i=0; $i < count($request['course_price']); $i++) {
            if ($request['course_price'][$i] != null) {
                $course = Courses::find($request['course_id'][$i]);
                if ($course != '') {
                    $courses[] = [
                        'course_id' => $request['course_id'][$i],
                        'original_price' => $course->price,
                        'bundle_price' => $request['course_price'][$i]
                    ];
                    $totalCourses += $request['course_price'][$i];
                }
            }
        }
        if ($totalCourses <= 0) {
            return redirect()->back()
                            ->with('faild','يجب إدخال أسعار الدورات التدريبية داخل المجموعة');
        }
        if ($request->price == '') {
            $data['price'] = $totalCourses;
        }
        $bundle = CoursesBundles::create($data);
        foreach ($courses as $key => $value) {
            $item_details = $value;
            $item_details['bundle_id'] = $bundle->id;
            $bundleItem = CoursesBundlesItems::create($item_details);
        }
        if ($bundle) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $courseId)
    {
        $data = $request->except(['_token']);

        $update = CoursesBundles::find($courseId)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($bundleId)
    {
        $bundle = CoursesBundles::find($bundleId);
        $items = $bundle->items != '' ? $bundle->items()->delete() : '';
        if ($bundle->delete()) {
            return Response::json($bundleId);
        }
        return Response::json("false");
    }
}
