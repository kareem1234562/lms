<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CoinsQs;
use Response;

class CoinsQsController extends Controller
{
    //
    public function index()
    {
        $CoinsQs = CoinsQs::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.coins_questions.index',[
            'active' => 'coins_questions',
            'title' => trans('learning.coins_questions'),
            'CoinsQs' => $CoinsQs,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('learning.coins_questions')
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);

        $page = CoinsQs::create($data);
        if ($page) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $id)
    {
        $page = CoinsQs::find($id);
        $data = $request->except(['_token']);

        $update = CoinsQs::find($id)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($id)
    {
        $page = CoinsQs::find($id);
        if ($page->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
