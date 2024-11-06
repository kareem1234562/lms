<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\TransactionRequests;
use App\Models\UserTransactions;
use Illuminate\Http\Request;
use Clickpaysa\Laravel_package\Facades\paypage;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        $course = Courses::findOrFail($request->product_id);

        $order = Orders::where('status','cart')->where('user_id',auth()->user()->id)->first();
        if (!$order) {
            $order = Orders::create([
                'user_id' => auth()->user()->id,
                'datetimestr' => strtotime(date('Y-m-d')),
                'status' => 'cart',
                'total' => $course->price
            ]);
        }
        $order_item = OrderItems::where('status','cart')
                                ->where('user_id',auth()->user()->id)
                                ->where('course_id',$course->id)
                                ->where('order_id',$order->id)
                                ->first();
        if (!$order_item) {
            $order_item = OrderItems::create([
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'course_id' => $course->id,
                'status' => 'cart',
                'price' => $course->price
            ]);
            $order->update(['total'=>$order->items()->sum('price')]);
        }

        return response()->json(['message' => 'تم إضافة الدورة التدريبية بنجاح']);
    }

    public function showCart()
    {
        // Retrieve cart data (e.g., from session or database)
        // Example: $cartItems = Cart::all();
        $order = Orders::where('status','cart')->where('user_id',auth()->user()->id)->first();

        return view('user.dashboard.cart', compact('order'));
    }
    public function removeItem($item_id)
    {
        $item = OrderItems::findOrFail($item_id);
        $order = Orders::find($item->order_id);
        $item->delete();
        $order->update(['total'=>$order->items()->sum('price')]);

        return back()->with('success' , 'تم الإزالة من سلة المشتريات بنجاح');
    }
    public function getCartCount()
    {
        // Retrieve cart count (e.g., from session or database)
        $cartCount = OrderItems::where('status','cart')
                                ->where('user_id',auth()->user()->id)
                                ->count();

        return response()->json(['count' => $cartCount]);
    }
    public function getCartCheckout()
    {
        $order = Orders::where('status','cart')->where('user_id',auth()->user()->id)->first();
        if ($order->total == 0) {
            $order->update(['status'=>'done']);
            if ($order->items()->count() > 0) {
                $order->items()->update(['status'=>'done']);

            }
            return redirect()->route('user.dashboard.index')->with('success','تمت عملية الشراء بنجاح');
        }
        $pay= paypage::sendPaymentCode('all')
                        ->sendTransaction('sale')
                        ->sendCart(strtotime(date('Y-m-d H:i:s')),$order->total,"دفع ثم الدورات التدريبية المشتراه")
                        ->sendCustomerDetails(auth()->user()->name, auth()->user()->email, auth()->user()->phone, 'test', 'Riyadh', 'Riyadh', 'SA', '1234',null)
                        ->sendShippingDetails(auth()->user()->name, auth()->user()->email, auth()->user()->phone, 'test', 'Riyadh', 'Riyadh', 'SA', '1234',null)
                        ->sendURLs(route('user.dashboard.cartCheckoutReturn'), route('user.dashboard.cartCheckoutCallBack'))
                        ->sendLanguage('en')
                        ->create_pay_page();
        return $pay;
    }
    public function cartCheckoutCallBack(Request $request)
    {
        $data = $request['data'];
        $data['status'] = 'confirm';
        $data['user_id'] = auth()->user()->id;
        $data['payment_type'] = 'online';
        $order = Orders::where('status','cart')->where('user_id',auth()->user()->id)->first();
        if ($order != '') {
            $order->update(['status'=>'done']);
            if ($order->items()->count() > 0) {
                $order->items()->update(['status'=>'done']);

            }
        }
        return redirect()->route('user.dashboard.index')
                        ->with('success',trans('common.successMessageText'));

    }
    public function cartCheckoutReturn()
    {
        return redirect()->route('user.dashboard.index')->with('faild','لم تتم عملية الدفع بنجاح يرجى مراجعة البنك');
    }
}
