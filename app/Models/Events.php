<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;
class Events extends Model
{
    //
    protected $guarded = [];
    public function photoLink() {
        $link = '';
        if ($this->photo != '') {
            if (File::exists('uploads/events/'.$this->id.'/'.$this->photo)){
                $link = asset('uploads/events/'.$this->id.'/'.$this->photo);
            }
        }
        return $link;
    }
}
