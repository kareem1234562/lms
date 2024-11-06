<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{

    function redirect() {
        return Socialite::driver('google')->redirect();
    }

    function callback() {
        try {
            $google_user = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $google_user->getEmail())->first();

            if (!$user) {
                $user_with_email = User::where('email',$google_user->getEmail())->first();
                if (!$user_with_email) {
                    $user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                        'role' => '3',
                        'status' => 'Active'
                    ]);
                } else {
                    $user = $user_with_email->update([
                        'email' => $google_user->getEmail()
                    ]);
                }

            }

            Auth::login($user);
            // Auth::logoutOtherDevices($user->password);

            return redirect()->route('website.index');

        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }
}
