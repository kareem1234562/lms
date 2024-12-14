<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use App\Models\New_Lessons;
use App\Models\NewCourses;
use App\Models\NewInstructors;
use App\Models\QuizCourse;
use App\Models\QuizLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;

use function Laravel\Prompts\table;

class NewCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = NewCourses::orderBy('id','desc')->paginate(10);
        return view('AdminPanel.new course.index',[
            'active' => 'new courses',
            'title' => 'الدورات التدريبية',
            'courses' => $courses,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => ''
                ]
            ]
        ]);




        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showinstructor($id){

        $course = NewCourses::find($id);
         $instructors=$course->Instructors_course()->paginate(5);
      return view('AdminPanel.instructorcourse.index',[
        'active' => 'new courses',
        'title' => 'الدورات التدريبية',
        'instructors' => $instructors,
        'breadcrumbs' => [
            [
                'url' => '',
                'text' => 'الدورات التدريبية'
            ]
        ]
    ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|Unique:new_courses|min:3|max:30',
            'Instructors' => 'required|array|min:1',
            'Explanatory_Video'=>'required|mimes:mp4,mov,ogg,qt',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'createcourse')
                ->withInput();
        }
        $data = $request->except(['_token']);

        // Convert instructors to JSON and add to data array
        $data['Instructors'] = json_encode($request->Instructors);

        // Handle file uploads
        $data['photo'] = upload_file('courses', $request->photo);
        $data['Explanatory_Video'] = upload_file('courses', $request->Explanatory_Video);



        // Create the course
        $course = NewCourses::create($data);

        if ($course) {
            // Decode Instructors back into an array
            $instructors = json_decode($data['Instructors'], true); // Ensure it's an array
            // $course->Instructors_forcourses()->sync($instructors);
            // Insert into pivot table
            foreach ($instructors as $instructorId) {
                DB::table('new_instructors_new_courses')->insert([
                    'new_courses_id' => $course->id,
                    'new_instructors_id' => $instructorId,
                ]);
            }

            return redirect()->back()->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()->with('faild', trans('common.faildMessageText'));
        }


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $course = NewCourses::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:new_courses,name,' . $course->id,
            'Instructors' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'editcourse_'.$course->id)
                ->withInput();
        }

// Exclude `_token` and `Discounted_Price` from request data
$data = $request->except(['_token', 'Discounted_Price']);
$data['Instructors'] = json_encode($request->Instructors);

// Handle `photo` upload
if ($request->hasFile('photo')) {
    $data['photo'] = upload_file('courses/', $request->photo);
} else {
    $data['photo'] = $course->photo; // Keep the old photo
}

// Handle `Explanatory_Video` upload
if ($request->hasFile('Explanatory_Video')) {
    $data['Explanatory_Video'] = upload_file('courses/', $request->Explanatory_Video);
} else {
    $data['Explanatory_Video'] = $course->Explanatory_Video; // Keep the old video
}

// Update course data
if ($course->update($data)) {
    // Decode instructors from JSON and sync with pivot table
    $instructors = json_decode($data['Instructors'], true);

    // Sync instructors to the pivot table
    $course->Instructors_course()->sync($instructors);

    return redirect()->back()->with('success', 'تم تعديل المحاضر بنجاح');
} else {
    return redirect()->back()->with('faild', 'لم يتم تعديل المحاضر بنجاح');
}

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $course = NewCourses::find($id);
        if ($course->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
        //
    }
}
