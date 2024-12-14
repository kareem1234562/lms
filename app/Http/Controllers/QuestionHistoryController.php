<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistoryQuizes;
use App\Models\QuizCourse;
use App\Models\QuizLesson;
use App\Models\SeperateQuiz;
use Illuminate\Http\Request;

class QuestionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $quiz_history=HistoryQuizes::find($id);
       if($quiz_history->course_id){
             $quis_course=QuizCourse::find($quiz_history->course_id);
             if($quis_course){
                $questions=$quis_course->questions()->paginate(10);
                return view('AdminPanel.questionhistory.index',[
                    'active' => 'new courses',
                    'title' => 'question history ',
                    'questions' => $questions,
                    'breadcrumbs' => [
                        [
                            'url' => '',
                            'text' => 'الدورات التدريبية'
                        ]
                    ]
                ]);
             }
       }else{
        $quis_lesson=QuizLesson::find($quiz_history->lesson_id);
        if($quis_lesson){
            $questions=$quis_lesson->questions()->paginate(10);
            return view('AdminPanel.questionhistory.index',[
                'active' => 'new courses',
                'title' => ' question history',

                'questions' => $questions,
                'breadcrumbs' => [
                    [
                        'url' => '',
                        'text' => 'الدورات التدريبية'
                    ]
                ]
            ]);
        }else{
          $seperate_quiz=SeperateQuiz::find($quiz_history->seperate_id);
          if($seperate_quiz){
            $questions=$seperate_quiz->questions()->paginate(10);
            return view('AdminPanel.questionhistory.index',[
                'active' => 'new courses',
                'title' => 'question history ',

                'questions' => $questions,
                'breadcrumbs' => [
                    [
                        'url' => '',
                        'text' => 'الدورات التدريبية'
                    ]
                ]
            ]);
          }
        }
       }
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
    public function store(Request $request)
    {
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
