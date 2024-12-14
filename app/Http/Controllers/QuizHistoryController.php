<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HistoryQuizes;
use Illuminate\Http\Request;

class QuizHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $course = HistoryQuizes::find($id);
        // $course_id=$course->id;
        $quizes=HistoryQuizes::paginate(10);

        return view('AdminPanel.quizhistory.index',[
            'active' => 'new courses',
            'title' => ' quiz history',
            'quizes' => $quizes,
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
