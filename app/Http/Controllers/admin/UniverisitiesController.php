<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Univerisities;
use App\Models\Countries;
use Response;

class UniverisitiesController extends Controller
{
    //
    public function index($country_id)
    {
        $country = Countries::find($country_id);
        $univerisities = Univerisities::where('country_id',$country_id)->orderBy('name_'.session()->get('Lang'),'desc')->paginate(25);
        return view('AdminPanel.univerisities.index',[
            'active' => 'univerisities',
            'title' => trans('learning.univerisities'),
            'univerisities' => $univerisities,
            'country' => $country,
            'breadcrumbs' => [
                [
                    'url' => route('admin.countries.index'),
                    'text' => trans('common.countries')
                ],
                [
                    'url' => '',
                    'text' => trans('learning.univerisities').': '.$country['name_'.session()->get('Lang')]
                ]
            ]
        ]);
    }

    public function store(Request $request,$country_id)
    {
        $data = $request->except(['_token']);
        $data['country_id'] = $country_id;
        $country = Univerisities::create($data);
        if ($country) {
            return redirect()->route('admin.univerisities',$country_id)
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $country_id, $id)
    {
        $user = Univerisities::find($id);
        $data = $request->except(['_token']);

        $update = Univerisities::find($id)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($country_id, $id)
    {
        $user = Univerisities::find($id);
        if ($user->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
