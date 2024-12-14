<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QuestionCourse;
use App\Models\QuizCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
class QuestionQuizCourse extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $quiz=QuizCourse::find($id);
        $quiz_id=$quiz->id;
        $questions=$quiz->questions()->paginate(10);
        return view('AdminPanel.questionquizcourse.index',[
            'active' => 'new courses',
            'title' => 'question quiz course ',
            'quiz_id'=>$quiz_id,
            'questions' => $questions,
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
            // Define the validation rules
            // Handle the file uploads and other data
            $data = $request->except('_token');
            $data['quiz_id'] = $id;

            // Upload the question file if present
            if ($request->hasFile('question')) {
                $data['question'] = upload_file('QuestionCourse', $request->question);
            }
            // Upload the correct_answer file if present
            if ($request->hasFile('correct_answer')) {
                $data['correct_answer'] = upload_file('Correct_AnswerCourse', $request->correct_answer);
            }
            // Handle option files (option1, option2, option3, etc.)

            for ($i = 1; $i <= 5; $i++) {
                if ($request->hasFile("option$i")) {
                    $data["option$i"] = upload_file("OptionsCourse/option$i", $request->file("option$i"));
                }
            }



            // Save the data into the database
            $store = QuestionCourse::create($data);

            if ($store) {
                return redirect()->back()->with('success', 'تم اضافة الدرس بنجاح');
            } else {
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
        $question=QuestionCourse::find($id);
    //    $end= endsWithAllowedExtensions($question->ques);
        if($request->hasFile('question')){
            $data['question']=upload_file('QuestionCourse', $request->question);
        }elseif(isset($request->question)&& $request->question!=$question->question){
            $data['question']=$request->question;
        }
        else{
            $data['question']=$question->question;
        }


        $options = ['option1', 'option2', 'option3', 'option4', 'option5'];

        foreach ($options as $option) {
            if ($request->hasFile($option)) {
                $data[$option] = upload_file('OptionsCourse/'.$option, $request->$option);
            } elseif (isset($request->$option) && $request->$option != $question->$option) {
                $data[$option] = $request->$option;
            } else {
                $data[$option] = $question->$option;
            }
        }



        if($request->hasFile('correct_answer')){
            $data['correct_answer']=upload_file('Correct_AnswerCourse', $request->correct_answer);
        }elseif(isset($request->correct_answer)&& $request->correct_answer!=$question->correct_answer){
            $data['correct_answer']=$request->correct_answer;
        }
        else{
            $data['correct_answer']=$question->correct_answer;
        }
        $update=$question->update($data);
        if($update){
            return redirect()->back()->with('success','تم التعديل بنجاح');
        }else{
            return redirect()->back()->with('faild','فشل التعديل');
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete( $id)
    {
        $question_course = QuestionCourse::find($id);
        if ($question_course->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
        //
    }
}
