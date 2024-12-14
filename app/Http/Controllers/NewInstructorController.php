<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewInstructors;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Response;
class NewInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = NewInstructors::orderBy('id','desc')->paginate(10);
        return view('AdminPanel.new instructor.index',[
            'active' => 'new courses',
            'title' => ' المحاضرين',
            'instructors' => $instructors,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => ' '
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

                        $validator = Validator::make($request->all(), [
                            'name' => 'required|min:3|max:30',
                            'email' => 'required|email|unique:new_instructors',
                            'Phone' => 'required|unique:new_instructors|numeric|min:11',
                            'Photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);

                        if ($validator->fails()) {
                            return redirect()->back()
                                ->withErrors($validator, 'createcourse')
                                ->withInput();
                        }
                        $instructor = $request->except(['_token']);
                        $image = upload_file('instructors/', $request->Photo);
                        $instructor['Photo'] = $image;

                        // Step 3: Save the data in the database
                        $instructor = NewInstructors::create($instructor);
                        if($instructor){
                            return redirect()->back()->with('success', 'تم اضافة المحاضر بنجاح');
                        }else{
                            return redirect()->back()->with('faild', 'لم يتم اضافة المحاضر بنجاح');
                        }
        // Step 2: Process the data only after validation succeeds
        // Step 4: Redirect with success message

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
    public function edit(Request $request,  $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $instructor = NewInstructors::find($id);


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:new_instructors,email,' . $instructor->id,
            'Phone' => 'required|numeric|min:11|unique:new_instructors,Phone,' . $instructor->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'editcourse_'.$instructor->id)
                ->withInput();
        }

        $data = $request->except(['_token', 'Photo']); // Exclude Photo if it's not being updated

        if ($request->hasFile('Photo')) {
            $data['Photo'] = upload_image_without_resize('instructors/', $request->Photo);
        } else {
            $data['Photo'] = $instructor->Photo; // Keep the old image without re-uploading
        }

        if ($instructor->update($data)) {
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
        $instructor = NewInstructors::find($id);
        if ($instructor->delete()) {

            return Response::json($id);
        }
        return Response::json("false");
        //
    }
}
