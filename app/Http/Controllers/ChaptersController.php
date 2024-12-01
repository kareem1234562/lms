<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use App\Models\NewCourses;
use Illuminate\Http\Request;
use Response;
class ChaptersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $chapters=NewCourses::find($id)->chapters()->paginate(10);
        $course_id=NewCourses::find($id)->id;
        return view('AdminPanel.chapters.index',[
            'active' => 'new courses',
            'title' => 'الدورات التدريبية',
            'course_id'=>$course_id,
            'chapters' => $chapters,
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
        $data=$request->except(['_token']);
        $data['course_id']=$id;
        $data['icon']=upload_image_without_resize('chapters', $request->icon);
        $chapters=Chapters::create($data);

        if($chapters){
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
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $chapter = Chapters::find($id);
        if($request->hasFile('icon')){
            $data['icon']=upload_image_without_resize('chapters', $request->icon);
        }else{
            $data['icon']= $chapter->icon;
        }

        $update=$chapter->update($data);
        if($update){
            return redirect()->back()->with('success', 'تم تعديل الدرس بنجاح');
        }else{
            return redirect()->back()->with('faild', 'فشلت عملية التعديل');
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $chapter = Chapters::find($id);
        if ($chapter->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
        //
    }
}
