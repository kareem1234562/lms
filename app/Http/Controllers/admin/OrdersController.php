<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use Response;

class OrdersController extends Controller
{
    //
    public function index()
    {
        $orders = Orders::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.orders.index',[
            'active' => 'orders',
            'title' => trans('common.orders'),
            'orders' => $orders,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.orders')
                ]
            ]
        ]);
    }

    public function details($id)
    {
        $details = Orders::find($id);

        return view('AdminPanel.orders.details', [
            'active' => 'orders',
            'title' => trans('common.orders'),
            'details' => $details,
            'breadcrumbs' => [
                [
                    'url' => route('admin.orders'),
                    'text' => trans('common.orders')
                ],
                [
                    'url' => '',
                    'text' => 'تفاصيل الطلب'
                ]
            ]
        ]);
    }
    public function confirm($id)
    {
        $order = Orders::find($id);
        $order->status = 'done';
        $order->update();
        if ($order->items()->count() > 0) {
            $order->items()->update(['status'=>'done']);
        }
        session()->flash('success', trans('common.successMessageText'));
        return redirect()->route('admin.orders');
    }
    public function delete($id)
    {
        $req = Orders::find($id);
        if ($req->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
