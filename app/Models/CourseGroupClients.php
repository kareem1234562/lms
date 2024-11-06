<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class CourseGroupClients extends Model
{
    //
    protected $guarded = [];
    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function group()
    {
        return $this->belongsTo(CourseGroups::class, 'group_id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    public function event()
    {
        return $this->belongsTo(Events::class, 'course_id');
    }
    public function payments()
    {
        return Revenues::where('course_id',$this->course_id)->where('client_id',$this->client_id)->sum('amount');
    }
    public function totals()
    {
        return [
            'expected_total_revenue' => $this->reservation_price,
            'collected_revenue' => $this->payments(),
            'rest_revenue' => $this->reservation_price - $this->payments()
        ];
    }
    public function certificateLink()
    {
        $link = '';
        if ($this->certificate != '') {
            if (File::exists('uploads/clients/'.$this->client_id.'/'.$this->id.'/'.$this->certificate)){
                $link = asset('uploads/clients/'.$this->client_id.'/'.$this->id.'/'.$this->certificate);
            }
        }
        return $link;
    }
}
