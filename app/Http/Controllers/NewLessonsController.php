<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use App\Models\New_Lessons;
use App\Models\NewCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

class NewLessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $course=NewCourses::find($id);
        $course_id=$course->id;
        $chapters = $course->chapters()
            ->orderBy('id', 'asc')
            ->pluck('number', 'id')
            ->toArray();

// Prepend a custom placeholder option

        $lessons=$course->Lessons_course()->paginate(10);
        return view('AdminPanel.newlessons.index',[
            'active' => 'new courses',
            'title' => ' lessons',
            'chapters'=>$chapters,
            'lessons' => $lessons,
            'course_id'=>$course_id,
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
        $validator = Validator::make($request->all(), [
            'number' => 'required|unique:new__lessons',
            'name' => 'required',
            'video' => 'required',
            'icon' => 'required',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'createcourse')
                ->withInput();
        }
        $data=$request->except('_token');
        $data['course_id']=$id;

     $chapter=Chapters::where('id', $request->chapter_id)->first();
         $chapter_id= $chapter?$chapter->id:null;
        if($chapter_id==null||$request->chapter_id==''){
            $data['chapter_id']=null;
        }else{
            $data['chapter_id']=$chapter_id;
        }
        $data['video']=upload_file('lessons/video', $request->video);
        $data['icon']=upload_file('lessons/icons', $request->icon);
        $data['file']=upload_file('lessons/files', $request->file);

        $lessons=New_Lessons::create($data);
        if($lessons){
            return redirect()->back()->with('success', 'تم اضافة الدرس بنجاح');
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
    public function update(Request $request, $id)
    {
        $lesson = New_Lessons::find($id);
        $validator = Validator::make($request->all(), [
            'number' => 'required|unique:new__lessons,number,' . $lesson->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'editchapter'.$lesson->id)
                ->withInput();
        }
        $data = $request->except(['_token']); // Exclude Photo if it's not being updated
        $data['chapter_id']=$request->chapter_id;
        if ($request->hasFile('icon')) {
            $data['icon'] = upload_file('lessons/icons/', $request->icon);
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
        $lesson = New_Lessons::find($id);
        if ($lesson->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
        //
    }
}
