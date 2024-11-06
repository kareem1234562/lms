<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransactions extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function order() {
        return $this->hasOne(Orders::class,'transaction_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
