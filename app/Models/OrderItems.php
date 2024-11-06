<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function order() {
        return $this->belongsTo(Orders::class,'order_id');
    }
    public function course() {
        return $this->belongsTo(Courses::class,'course_id');
    }
}
