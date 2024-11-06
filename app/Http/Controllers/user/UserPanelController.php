<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courses;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\UserTransactions;
use App\Models\TransactionRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Clickpaysa\Laravel_package\Facades\paypage;


class UserPanelController extends Controller
{
    //
    public function login()
    {
        return view('user.auth.login');
    }
    public function signup()
    {
        return view('user.auth.signup');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('website.login');
    }
    public function signupSubmit(Request $request)
    {
        if ($request->filled('hp_field')) {
            // Honeypot field is filled, this is likely a bot
            return redirect()->back()->with('error', 'Bot detected.');
        }
        $data = $request->except(['_token','password','hp_field']);
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()
                            ->withErrors($validator)
                            ->with('faild',trans('common.faildMessageText'));
        }

        $data['password'] = bcrypt($request['password']);
        $data['status'] = 'Active';
        $data['role'] = '3';

        $user = User::create($data);
        // Trigger sending of email verification notification
        $user->sendEmailVerificationNotification();
        if ($user) {
            // Auth::loginUsingId($user->id);
            // return redirect()->route('website.index')
            //                 ->with('success',trans('common.successMessageText'));
            return redirect()->route('website.login')
                            ->with('success','تم ارسالة رسالة لتفعيل الحساب الخاص بك عبر البريد الإلكتروني يرجى فتحها على نفس المتصفح بعد تسجيل الدخول');
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }



    public function loginSubmit(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        } elseif (is_numeric($request->email)) {
            $fieldType = 'phone';
        } else {
            $fieldType = 'username';
        }

        if (auth()->attempt([$fieldType=>$input['email'],'password'=>$input['password']])) {
            // if (auth()->user()->email_verified_at == '') {
            //     session()->put('faild','البريد الإلكتروني الخاص بك غير مفعل يرجى التأكد من تفعيل حسابك عبر البريد الإلكتروني');
            //     auth()->logout();
            //     return redirect()->back()->withInput();
            // }
            if (isset($request['coins'])) {
                if (auth()->user()->last_coin_answer < strtotime(date('Y-m-d'))) {
                    auth()->user()->update([
                        'coins'=>auth()->user()->coins + $request->coins,
                        'last_coin_answer' => strtotime(date('Y-m-d'))
                    ]);
                }
            }
            if (auth()->user()->checkActive() != '1') {
                session()->put('faild',auth()->user()->checkActive());
                auth()->logout();
                return redirect()->back()->withInput();
            }
            if ( auth()->user()->role == '1' || auth()->user()->role == '2') {
                return redirect()->route('admin.index');
            }
            elseif( auth()->user()->role == '3' ) {
                if (auth()->user()->user_ip == '') {
                    auth()->user()->update(['user_ip'=>$request->header('X-Forwarded-For')]);
                    Auth::logoutOtherDevices($input['password']);
                } else {
                    if ($request->header('X-Forwarded-For') != auth()->user()->user_ip) {
                        session()->put('faild','لقد لاحظنا تسجيل الدخول من جهاز آخر غير المسجل لدينا يرجى تسجيل الدخول من جهازك الأصل أو التواصل مع الإدارة');
                        auth()->logout();
                        return redirect()->back()->withInput();
                    }
                }
                return redirect()->back();
            } else {
                return back();
            }
        } else {
            session()->put('faild',trans('auth.failed'));
            return redirect()->back()->withInput();
        }
    }

    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('website.index');
        }
        return view('user.dashboard.index');
    }
    public function editProfile()
    {
        return view('user.dashboard.profile');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->except(['_token','photo','password_confirmation','password']);
        // return $data;
        if ($request->photo != '') {
            if (auth()->user()->profile_photo != '') {
                delete_image('users/'.auth()->user()->id , auth()->user()->profile_photo);
            }
            $data['profile_photo'] = upload_image_without_resize('users/'.auth()->user()->id , $request->photo );
        }
        if ($request['password'] != '') {
            $rules = [
                'password' => 'required|confirmed',
            ];
            $validator=Validator::make($request->all(),$rules);
            if($validator->fails())
            {
                return redirect()->back()
                                ->withErrors($validator)
                                ->with('faild',trans('common.faildMessageText'));
            }
        } else {
            $data['password'] = bcrypt($request['password']);
        }

        $update = User::find(auth()->user()->id)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function rechargeBalance(Request $request)
    {
        // $data = $request->except(['_token','photo','payment_method']);
        // $data['user_id'] = auth()->user()->id;
        // $data['status'] = 'pending';
        // $data['payment_type'] = $request['payment_method'];
        $order = Orders::where('status','cart')->where('user_id',auth()->user()->id)->first();
        if ($request['payment_method'] == 'online') {
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

        $request->validate([
            'photo' => 'required|image', // or 'required|image' if it's an image
        ]);
        if ($order) {
            $order->update(['status'=>'pending']);
            if ($order->items()->count() > 0) {
                $order->items()->update(['status'=>'pending']);
            }
            if ($request->photo != '') {
                $the_file = upload_file('orders/'.$order->id , $request->photo );
                $order->update(['file'=>$the_file]);
            }
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function rechargeBalanceCallBack(Request $request)
    {
        $data = $request['data'];
        $data['status'] = 'confirm';
        $data['user_id'] = auth()->user()->id;
        $data['payment_type'] = 'online';

        $req = TransactionRequests::create($data);
        if ($req) {
            $transaction = UserTransactions::create([
                'user_id' => $req->user_id,
                'request_id' => $req->id,
                'in' => $req->amount,
                'payment_method' => $req->payment_type,
                'datetimestr' => strtotime(date('Y-m-d'))

            ]);

            return redirect()->route('user.dashboard.index')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }
    public function rechargeBalanceReturn(Request $request)
    {
        return redirect()->route('user.dashboard.index')->with('faild','لم تتم عملية الدفع بنجاح يرجى مراجعة البنك');
    }
    public function createOrder($course_id)
    {
        $user = auth()->user();
        if ($user->studentCourses()->where('course_id',$course_id)->first() != '') {
            return redirect()->route('user.dashboard.index');
        }

        $course = Courses::find($course_id);

        $order = Orders::create([
            'user_id' => auth()->user()->id,
            'datetimestr' => strtotime(date('Y-m-d')),
            'status' => 'done',
            'total' => $course->price
        ]);
        $order_item = OrderItems::create([
            'order_id' => $order->id,
            'user_id' => auth()->user()->id,
            'course_id' => $course_id,
            'status' => 'done',
            'price' => $course->price
        ]);

        $transaction = UserTransactions::create([
            'out' => $order->total,
            'payment_method' => 'wallet',
            'payment_method' => strtotime(date('Y-m-d')),
            'user_id' => auth()->user()->id
        ]);

        $order->update(['transaction_id'=>$transaction->id]);
        return redirect()->back()
                        ->with('success',trans('common.successMessageText'));

    }
}
