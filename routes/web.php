<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontend\CoursesController;
use App\Http\Controllers\frontend\CurriculumsController;
use App\Http\Controllers\frontend\EventsController;
use App\Http\Controllers\frontend\TrainersController;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminPanelController;
use App\Http\Controllers\user\UserPanelController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\Auth\GoogleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *
 * website
 *
 */

 Route::get('/auth/google',[GoogleController::class, 'redirect'])->name('auth.google.redirect');
 Route::get('/auth/google/callback',[GoogleController::class, 'callback'])->name('auth.google.callback');


Route::get('/',[HomeController::class, 'index'])->name('website.index');
Route::get('/aboutus',[HomeController::class, 'aboutus'])->name('website.aboutus');
Route::get('/faqs',[HomeController::class, 'faqs'])->name('website.faqs');
Route::get('/contactus',[HomeController::class, 'contactus'])->name('website.contactus');
Route::get('/search',[HomeController::class, 'search'])->name('website.students.search');
Route::get('/book/{type}/{id}',[HomeController::class, 'book'])->name('website.book');
Route::post('/book/{type}/{id}',[HomeController::class, 'bookSubmit'])->name('website.book.submit');

Route::group(['prefix'=>'courses'], function(){
    Route::get('/',[CoursesController::class, 'index'])->name('website.courses');
    Route::get('/{id}/details',[CoursesController::class, 'details'])->name('website.courses.details');
    Route::get('/{id}/lesson/{lesson_id}',[CoursesController::class, 'lesson'])->name('website.courses.lesson');
});
Route::group(['prefix'=>'curriculums'], function(){
    Route::get('/',[CurriculumsController::class, 'index'])->name('website.curriculums');
    Route::get('/{id}/details',[CurriculumsController::class, 'details'])->name('website.curriculums.details');
});
Route::group(['prefix'=>'events'], function(){
    Route::get('/',[EventsController::class, 'index'])->name('website.events');
    Route::get('/{id}/details',[EventsController::class, 'details'])->name('website.events.details');
});
Route::group(['prefix'=>'trainers'], function(){
    Route::get('/',[TrainersController::class, 'index'])->name('website.trainers');
    Route::get('/{id}/details',[TrainersController::class, 'details'])->name('website.trainers.details');
});
Route::group(['prefix'=>'blog'], function(){
    Route::get('/',[BlogController::class, 'index'])->name('website.blog');
    Route::get('/{id}/details',[BlogController::class, 'details'])->name('website.blog.details');
});
Route::group(['prefix'=>'ajax'], function(){
    Route::get('/GetUniversityList',[CurriculumsController::class, 'GetUniversityList'])->name('website.ajax.GetUniversityList');
});

Route::post('/storeMessage', [HomeController::class, 'storeMessage'])->name('message.store');
Route::post('/loggedoutCoins', [HomeController::class, 'loggedoutCoins'])->name('loggedoutCoins');



Route::get('SwitchLang/{lang}',function($lang){
    session()->put('Lang',$lang);
    app()->setLocale($lang);
    if (auth()->check()) {
        $user = App\Models\User::find(auth()->user()->id)->update(['language'=>$lang]);
    }
	return Redirect::back();
});

Auth::routes(['verify' => true]);
Route::get('admin/auth/login',[AdminLoginController::class, 'login'])->name('admin.login');
Route::get('user/login',[UserPanelController::class, 'login'])->name('website.login');
Route::post('user/login',[UserPanelController::class, 'loginSubmit'])->name('website.login.submit');
Route::get('user/signup',[UserPanelController::class, 'signup'])->name('website.signup');
Route::post('user/signup',[UserPanelController::class, 'signupSubmit'])->name('website.signup.submit');
Route::get('user/logout',[UserPanelController::class, 'logout'])->name('website.logout');



Route::get('AdminPanel/changeTheme',[AdminPanelController::class, 'changeTheme'])->name('changeTheme');



/**
 *
 * user dashboard
 *
 */
Route::group(['prefix'=>'UserPanel'], function(){
    Route::get('/',[UserPanelController::class, 'index'])->name('user.dashboard.index')->middleware(['auth', 'verified']);
    Route::get('/editProfile',[UserPanelController::class, 'editProfile'])->name('user.dashboard.editProfile')->middleware(['auth', 'verified']);
    Route::post('/editProfile',[UserPanelController::class, 'updateProfile'])->name('user.dashboard.updateProfile')->middleware(['auth', 'verified']);
    Route::post('/rechargeBalance',[UserPanelController::class, 'rechargeBalance'])->name('user.dashboard.rechargeBalance')->middleware(['auth', 'verified']);
    Route::group(['prefix'=>'orders'], function(){
        Route::get('/create/{course_id}',[UserPanelController::class, 'createOrder'])->name('user.order.create')->middleware(['auth', 'verified']);
    });
    Route::post('/cart/add',[CartController::class, 'addItem'])->name('user.cart.add')->middleware(['web', 'verified']);
    Route::get('/cart',[CartController::class, 'showCart'])->name('user.cart.show')->middleware(['web', 'verified']);
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('user.cart.count')->middleware(['web', 'verified']);
    Route::get('/cart/checkout', [CartController::class, 'getCartCheckout'])->name('user.cart.checkout')->middleware(['web', 'verified']);
    Route::get('/cart/removeItem/{id}', [CartController::class, 'removeItem'])->name('user.cart.removeItem')->middleware(['web', 'verified']);
});
Route::post('/cartCheckoutCallBack',[CartController::class, 'cartCheckoutCallBack'])->name('user.dashboard.cartCheckoutCallBack');
Route::post('/cartCheckoutReturn',[CartController::class, 'cartCheckoutReturn'])->name('user.dashboard.cartCheckoutReturn');

Route::post('/rechargeBalanceCallBack',[UserPanelController::class, 'rechargeBalanceCallBack'])->name('user.dashboard.rechargeBalanceCallBack');
Route::post('/rechargeBalanceReturn',[UserPanelController::class, 'rechargeBalanceReturn'])->name('user.dashboard.rechargeBalanceReturn');
