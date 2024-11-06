<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionRequests;
use App\Models\UserTransactions;
use Response;

class TransactionsRequestsController extends Controller
{
    //
    public function index()
    {
        $requests = TransactionRequests::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.TransactionRequests.index',[
            'active' => 'transactionRequests',
            'title' => trans('common.transactionsRequests'),
            'requests' => $requests,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.transactionsRequests')
                ]
            ]
        ]);
    }

    public function details($id)
    {
        $details = TransactionRequests::find($id);

        return view('AdminPanel.TransactionRequests.details', [
            'active' => 'transactionRequests',
            'title' => trans('common.transactionsRequests'),
            'details' => $details,
            'breadcrumbs' => [
                [
                    'url' => route('admin.transactionsRequests'),
                    'text' => trans('common.transactionsRequests')
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
        $req = TransactionRequests::find($id);
        $req->status = 'confirm';
        $req->update();

        $transaction = UserTransactions::create([
            'user_id' => $req->user_id,
            'request_id' => $req->id,
            'in' => $req->amount,
            'payment_method' => $req->payment_method,
            'datetimestr' => strtotime(date('Y-m-d'))

        ]);
        session()->flash('success', trans('common.successMessageText'));
        return back();
    }
    public function delete($id)
    {
        $req = TransactionRequests::find($id);
        if ($req->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
