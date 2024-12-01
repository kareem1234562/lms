<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use App\Models\New_Lessons;
use Illuminate\Http\Request;
use Response;
class LessonsChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $chapter = Chapters::find($id);
        $chapter_id=$chapter->id;
        $lessons=$chapter->lessons_chapter()->paginate(10);
        return view('AdminPanel.lessonschapter.index',[
            'active' => 'new courses',
            'title' => 'الدورات التدريبية',
            'chapter_id'=>$chapter_id,
            'lessons' => $lessons,
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
         $data['chapter_id']=$id;
         $course_id=Chapters::find($id)->course_chapter;
         $course_id=$course_id->id;
         $data['course_id']=$course_id;

         $data['video']=upload_file('lessons/video', $request->video);
         $data['icon']=upload_file('lessons/icons', $request->icon);
         $data['file']=upload_file('lessons/files', $request->file);

         $lesson=New_Lessons::create($data);

         if($lesson){
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
        $lesson = New_Lessons::find($id);
        $data = $request->except(['_token']); // Exclude Photo if it's not being updated
        
        if ($request->hasFile('icon')) {
            $data['icon'] = upload_image_without_resize('lessons/icons/', $request->icon);
        } else {
            $data['icon'] = $lesson->icon; // Keep the old image without re-uploading
        }
        if ($request->hasFile('video')) {
            $data['video'] = upload_file('lessons/video/', $request->video);
        } else {
            $data['video'] = $lesson->video; // Keep the old image without re-uploading
        }
        if ($request->hasFile('file')) {
            $data['file'] = upload_file('lessons/files/', $request->file);
        } else {
            $data['file'] = $lesson->file; // Keep the old image without re-uploading
        }

        if ($lesson->update($data)) {
            return redirect()->back()->with('success', 'تم تعديل المحاضر بنجاح');
        } else {
            return redirect()->back()->with('faild', 'لم يتم تعديل المحاضر بنجاح');
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete( $id)
    {
        $lesson=New_Lessons::find($id);
        if ($lesson->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
        //
    }
}
