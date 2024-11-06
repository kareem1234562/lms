<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class Orders extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function items() {
        return $this->hasMany(OrderItems::class,'order_id');
    }
    public function transaction() {
        return $this->belongsTo(UserTransactions::class,'transaction_id');
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
    public function requestStatus()
    {
      $text = '<span class="';
      if ($this->status == 'pending') {
        $text .= 'text-danger">';
        $text .= 'قيد المراجعة';
      } elseif ($this->status == 'done') {
        $text .= 'text-success">';
        $text .= 'تم التنفيذ';
      } else {
        $text .= 'text-muted">';
        $text .= 'في سلة المشتريات';
      }
      $text .= '</span>';
      return $text;
    }
    public function photoLink() {
        $link = '';
        if ($this->file != '') {
            if (File::exists('uploads/orders/'.$this->id.'/'.$this->file)){
                $link = asset('uploads/orders/'.$this->id.'/'.$this->file);
            }
        }
        return $link;
    }
}
