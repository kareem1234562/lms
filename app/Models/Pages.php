<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    //
    protected $guarded = [];
    public function apiData($lang){
        return [
            'id' => $this['id'],
            'title' => $this['title_'.$lang],
            'content' => $this['content_'.$lang],
        ];
    }
}
