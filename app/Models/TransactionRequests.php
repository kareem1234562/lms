<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class TransactionRequests extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function requestStatus()
    {
      $text = '<span class="';
      if ($this->status == 'pending') {
        $text .= 'text-danger">';
        $text .= trans('common.unread');
      } else {
        $text .= 'text-muted">';
        $text .= trans('common.read');
      }
      $text .= '</span>';
      return $text;
    }
    public function photoLink() {
        $link = '';
        if ($this->file != '') {
            if (File::exists('uploads/transactionsRequests/'.$this->user_id.'/'.$this->file)){
                $link = asset('uploads/transactionsRequests/'.$this->user_id.'/'.$this->file);
            }
        }
        return $link;
    }
}
