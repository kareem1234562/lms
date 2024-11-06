<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseGroups extends Model
{
    //
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Courses::class,'course_id');
    }
    public function clients()
    {
        return $this->hasMany(CourseGroupClients::class,'group_id');
    }
    public function times()
    {
        return $this->hasMany(CourseGroupTimes::class,'group_id');
    }
    public function today()
    {
        return $this->times()->where('day',date('l'))->first();
    }
    public function thisMonthSessions() {
        $date = new \DateTime('first day of this month');
        $thisMonth = $date->format('m');

        $days = [];
        foreach ($this->times as $key => $value) {
            while ($date->format('m') === $thisMonth) {
                $date->modify('next '.$value->day);
                $days[] = [
                    'from' => $date->format('D M j '.$value->time_from),
                    'to' => $date->format('D M j '.$value->time_to)
                ];
            }
        }
        return $days;
    }
    public function revenues()
    {
        return $this->hasMany(Revenues::class,'group_id');
    }
    public function totals()
    {
        return [
            'expected_total_revenue' => $this->clients()->sum('reservation_price'),
            'collected_revenue' => $this->revenues()->sum('amount'),
            'rest_revenue' => $this->clients()->sum('reservation_price') - $this->revenues()->sum('amount')
        ];
    }
    public function canDelete()
    {
        $status = true;
        if ($this->clients()->count() > 0) {
            $status = false;
        }
        if ($this->times()->count() > 0) {
            $status = false;
        }
        if ($this->revenues()->count() > 0) {
            $status = false;
        }
        return $status;
    }
}
