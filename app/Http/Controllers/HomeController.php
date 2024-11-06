<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Courses;
use App\Models\Clients;
use App\Models\Events;
use App\Models\CoursesSections;
use App\Models\Univerisities;
use App\Models\Colleges;
use App\Models\ContactMessages;
use App\Models\CoinsQs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('FrontEnd.index');
    }
    public function aboutus()
    {
        return view('FrontEnd.pages.aboutus');
    }
    public function contactus()
    {
        return view('FrontEnd.pages.contactus');
    }
    public function book($type, $id)
    {
        if ($type == 'course') {
            $data = Courses::find($id);
            $title = 'حجز الدورة التدريبية: '.$data->name;
        } else {
            $data = Courses::find($id);
            $title = 'حجز ورشة العمل: '.$data->title;
        }

        return view('FrontEnd.pages.book',compact('type', 'id', 'title'));
    }
    public function loggedoutCoins(Request $request)
    {
        $q = CoinsQs::find($request['q_id']);
        if ($q == '') {
            return redirect()->route('website.index');
        }
        $coins = 0;
        if ($q['true_answer'] == $request['coinAnswer']) {
            $coins = $q['coins'];
        }
        session()->put('coins',$coins);
        if (auth()->check()) {
            return redirect()->route('user.dashboard.index');
        }
        return redirect()->route('website.login');
    }

    public function storeMessage(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
        'address' => 'required',
        'content' => 'required|string|max:255',
      ]);
      if (!$validator->passes()) {
        return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
      } else {
        $value = [
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'address' => $request->address,
          'content' => $request->content,
        ];

        $message = ContactMessages::create($value);
        $message->save();
        return redirect()->back()->with(['success'=>trans('common.successMessageText')]);
      }
    }

    public function search() {
        $courses = [];
        $curriculums = [];
        $sections = [];
        $Univerisities = [];
        $Colleges = [];
        if (isset($_GET['s'])) {
            if ($_GET['s'] != '') {
                $courses = Courses::where('name','LIKE','%'.$_GET['s'].'%')->where('is_course',1)->orderBy('id','desc')->take(5)->get();
                $curriculums = Courses::where('name','LIKE','%'.$_GET['s'].'%')->where('is_course',0)->orderBy('id','desc')->take(5)->get();
                $sections = CoursesSections::where('name_ar','LIKE','%'.$_GET['s'].'%')->orWhere('name_en','LIKE','%'.$_GET['s'].'%')->orderBy('id','desc')->take(5)->get();
                $Univerisities = Univerisities::where('name_ar','LIKE','%'.$_GET['s'].'%')->orWhere('name_en','LIKE','%'.$_GET['s'].'%')->orderBy('id','desc')->take(5)->get();
                $Colleges = Colleges::where('name_ar','LIKE','%'.$_GET['s'].'%')->orWhere('name_en','LIKE','%'.$_GET['s'].'%')->orderBy('id','desc')->take(5)->get();
            }
        }
        return view('FrontEnd.search',compact('courses', 'curriculums', 'sections', 'Univerisities', 'Colleges'));
    }
}
