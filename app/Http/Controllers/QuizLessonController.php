<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistoryQuizes;
use App\Models\New_Lessons;
use App\Models\QuizLesson;
use Illuminate\Http\Request;
use Response;

class QuizLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $course = New_Lessons::find($id);
        $course_id=$course->id;
        $quizes=$course->quizes()->paginate(10);

        return view('AdminPanel.quizlesson.index',[
            'active' => 'new courses',
            'title' => 'الدورات التدريبية',
            'course_id'=>$course_id,
            'quizes' => $quizes,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'الدورات التدريبية'
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $data=$request->except('_token');
        $data['lesson_id']=$id;

        $data['icon']=upload_file('quizlesson/icons', $request->icon);


        $quiz=QuizLesson::create($data);

        if($quiz){
            $history=HistoryQuizes::create($data);
            if($history){
              $history->update([
                'lesson_id'=>$quiz->id,
              ]);
              return redirect()->back()->with('success', 'تم اضافة الدرس بنجاح');
            }

        }else{
            return redirect()->back()->with('faild', 'فشلت عملية الاضافة');
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
        $data=$request->except('_token');
        $quiz=QuizLesson::find($id);
       if($request->hasFile('icon')){
           $data['icon']=upload_file('quizlesson/icons', $request->icon);
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
        $question_course = QuizLesson::find($id);
        if ($question_course->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
        //
    }
}
