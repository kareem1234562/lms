<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistoryQuizes;
use App\Models\SeperateQuiz as ModelsSeperateQuiz;
use Illuminate\Http\Request;
use Response;

class SeperateQuiz extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $quizes = ModelsSeperateQuiz::paginate(10);
        return view('AdminPanel.quizseperate.index',[
            'active' => 'new courses',
            'title' => 'الدورات التدريبية',
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
    public function store(Request $request)
    {
        $data=$request->except('_token');

        $data['icon']=upload_file('quizseperate/icons', $request->icon);


        $quiz=ModelsSeperateQuiz::create($data);

        if($quiz){
            $history=HistoryQuizes::create($data);
            $history->seperate_id=$quiz->id;
            $history->save();
            return redirect()->back()->with('success', 'تم اضافة الدرس بنجاح');
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
        $quiz=ModelsSeperateQuiz::find($id);
       if($request->hasFile('icon')){
           $data['icon']=upload_file('quizseperate/icons', $request->icon);
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
        $quiz = ModelsSeperateQuiz::find($id);
        if ($quiz->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
    }
}
