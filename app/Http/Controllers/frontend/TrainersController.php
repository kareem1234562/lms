<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Response;

class TrainersController extends Controller
{
    public function index()
    {
        $instructors = User::where('role',2)->orderBy('id','desc')->paginate(12);
        return view('FrontEnd.instructors.index',[
            'instructors' => $instructors
        ]);
    }
    public function details($id)
    {
        $details = User::find($id);
        $instructors = User::orderBy('id','desc')->paginate(12);
        return view('FrontEnd.instructors.details',[
            'instructors' => $instructors,
            'details' => $details
        ]);
    }
}
