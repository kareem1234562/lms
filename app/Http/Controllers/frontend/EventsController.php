<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use Response;

class EventsController extends Controller
{
    public function index()
    {
        $events = Events::orderBy('id','desc')->paginate(12);
        return view('FrontEnd.events.index',[
            'events' => $events
        ]);
    }
    public function details($id)
    {
        $details = Events::find($id);
        $events = Events::orderBy('id','desc')->paginate(12);
        return view('FrontEnd.events.details',[
            'events' => $events,
            'details' => $details
        ]);
    }
}
