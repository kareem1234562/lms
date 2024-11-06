<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hisRole()
    {
        return $this->belongsTo(roles::class,'role');
    }
    public function photoLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar-s-11.jpg');

        if ($this->profile_photo != '') {
            $image = asset('uploads/users/'.$this->id.'/'.$this->profile_photo);
        }

        return $image;
    }
    public function identityLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar-s-11.jpg');

        if ($this->identity != '') {
            $image = asset('uploads/users/'.$this->id.'/'.$this->identity);
        }

        return $image;
    }
    public function countryData()
    {
        return $this->belongsTo(Countries::class,'country');
    }
    public function governorateData()
    {
        return $this->belongsTo(Governorates::class,'governorate');
    }
    public function cityData()
    {
        return $this->belongsTo(Cities::class,'city');
    }
    public function addressList()
    {
        return $this->hasMany(UserAddress::class,'user_id');
    }
    public function paymentMethods()
    {
        return $this->hasMany(UserPaymentMethods::class,'user_id');
    }
    public function bookReviews()
    {
        return $this->hasMany(BookReviews::class,'user_id');
    }
    public function apiData($lang,$details = null)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'userName' => $this->userName,
            'email' => $this->email,
            'language' => $this->language,
            'phone' => $this->phone,
            'address' => $this->address,
            'about' => $this->about,
            'photo' => $this->photoLink(),
            'country' => $this->countryData != '' ? $this->countryData->apiData($lang) : ['id'=>'','name'=>''],
            'governorate' => $this->governorateData != '' ? $this->governorateData->apiData($lang) : ['id'=>'','name'=>''],
            'city' => $this->cityData != '' ? $this->cityData->apiData($lang) : ['id'=>'','name'=>'']
        ];
        if ($details != '') {
            if ($this->publisherBooks()->count() > 0) {
                $books = $this->publisherBooks;
                $data['publisherBooks'] = [];
                foreach ($books as $key => $value) {
                    $data['publisherBooks'][] = $value->apiData($lang);
                }
            }
        }

        return $data;
    }

    public function publisherBooks()
    {
        return $this->hasMany(Books::class,'publisher_id');
    }

    public function checkActive()
    {
        $active = '1';
        if ($this->active == '0') {
            $active = trans('auth.yourAcountStillNotActive');
        }
        if ($this->block == '1') {
            $active = trans('auth.yourAcountIsBlocked');
        }
        return $active;
    }

    public function publisherClients()
    {
        return $this->hasManyThrough(
            'App\Models\User',
            'App\Orders',
            'publisher_id', // Local key on users table...
            'id', // Local key on users table...
        );
    }

    function mySales()
    {
        return 0;
    }

    public function paymentsHistory()
    {
        return $this->hasMany(PublisherPaymentsHistory::class,'user_id');
    }

    public function courses() {
        return $this->hasMany(Courses::class,'instructor_id');
    }
    public function studentsCount() {
        $count = 0;
        foreach ($this->courses as $key => $value) {
            $count += $value->clients()->count();
        }
        return $count;
    }
    public function studentCourses() {
        return $this->belongsToMany(Courses::class, OrderItems::class, 'user_id', 'course_id')
                    ->withPivot('status')
                    ->wherePivotIn('status', ['done','pending']);
    }
    public function studentLessons() {
        return $this->belongsToMany(Courses::class, OrderItems::class, 'user_id', 'lesson_id');
    }
    public function certificates() {
        $count = 0;

        return $count;
    }
    public function transactions() {
        return $this->hasMany(UserTransactions::class,'user_id');
    }
    public function walletNet() {
        $net = 0;
        foreach ($this->transactions as $key => $value) {
            $net += $value->in;
            $net -= $value->out;
        }
        return $net;
    }
    public function orders() {
        return $this->hasMany(Orders::class,'user_id');
    }

}
