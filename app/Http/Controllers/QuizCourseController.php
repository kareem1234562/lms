<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistoryQuizes;
use App\Models\NewCourses;
use App\Models\QuizCourse;
use App\Models\QuizLesson;
use Illuminate\Http\Request;
use Response;

class QuizCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $course = NewCourses::find($id);
        $course_id=$course->id;
        $quizes=$course->quizes()->paginate(10);

        return view('AdminPanel.quizescourse.index',[
            'active' => 'new courses',
            'title' => 'quizes course',
            'course_id'=>$course_id,
            'quizes' => $quizes,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'الدورات التدريبية'
                ]
            ]
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $data=$request->except('_token');
        $data['course_id']=$id;

        $data['icon']=upload_file('quizescourse/icons', $request->icon);

        $quiz=QuizCourse::create($data);

        if($quiz){
            $history=HistoryQuizes::create($data);
            if($history){
              $history->update([
                'course_id'=>$quiz->id,
              ]);
              return redirect()->back()->with('success', 'تم اضافة الدرس بنجاح');
            }

        }else{
            return redirect()->back()->with('faild', 'فشلت عملية الاضافة');
        }
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
        $data=$request->except('_token');
         $quiz=QuizCourse::find($id);
        if($request->hasFile('icon')){
            $data['icon']=upload_file('quizescourse/icons', $request->icon);
        }else{
            $data['icon']=$quiz->icon;
        }

        $update=$quiz->update($data);
        if($update){
            return redirect()->back()->with('success', 'تم تعديل المحاضر بنجاح');
        }else{
            return redirect()->back()->with('faild', 'لم يتم تعديل المحاضر بنجاح');
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete( $id)
    {
        //
        $quiz = QuizCourse::find($id);
        if ($quiz->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
    }
}
