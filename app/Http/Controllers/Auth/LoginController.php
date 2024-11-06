<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        if ( auth()->user()->role == '1' || auth()->user()->role == '3') {
            return route('admin.index');
        }
        elseif ( auth()->user()->role == '2') {
            return route('doctor.index');
        }
        else {
            return route('publisher.index');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
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
                return redirect()->route('website.index');
            } else {
                return back();
            }
        } else {
            session()->put('faild',trans('auth.failed'));
            return redirect()->back()->withInput();
        }
    }

    public function showLoginForm()
    {
        return view('auth.login',[
            'active' => '',
            'title' => trans('common.Sign in')
        ]);
    }

    protected function loggedOut(Request $request) {
        return redirect()->route('login');
    }
}
