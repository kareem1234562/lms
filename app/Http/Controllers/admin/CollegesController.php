<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Colleges;
use App\Models\Univerisities;
use App\Models\Countries;
use Response;

class CollegesController extends Controller
{
    //
    public function index($country_id, $university_id)
    {
        $country = Countries::find($country_id);
        $univerisity = Univerisities::find($university_id);
        $colleges = Colleges::where('country_id',$country_id)->where('university_id',$university_id)->orderBy('name_'.session()->get('Lang'),'desc')->paginate(25);
        return view('AdminPanel.colleges.index',[
            'active' => 'univerisities',
            'title' => trans('learning.colleges'),
            'colleges' => $colleges,
            'univerisity' => $univerisity,
            'country' => $country,
            'breadcrumbs' => [
                [
                    'url' => route('admin.countries.index'),
                    'text' => trans('common.countries')
                ],
                [
                    'url' => route('admin.univerisities',$country->id),
                    'text' => trans('learning.univerisities').': '.$country['name_'.session()->get('Lang')]
                ],
                [
                    'url' => '',
                    'text' => trans('learning.colleges').': '.$univerisity['name_'.session()->get('Lang')]
                ]
            ]
        ]);
    }

    public function store(Request $request,$country_id,$university_id)
    {
        $data = $request->except(['_token']);
        $data['country_id'] = $country_id;
        $data['university_id'] = $university_id;
        $country = Colleges::create($data);
        if ($country) {
            return redirect()->route('admin.colleges',['countryId'=>$country_id,'UniId'=>$university_id])
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $country_id,$university_id, $id)
    {
        $data = $request->except(['_token']);

        $update = Colleges::find($id)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($country_id,$university_id, $id)
    {
        $user = Colleges::find($id);
        if ($user->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
