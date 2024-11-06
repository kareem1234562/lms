<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Instructors;
use App\Models\CourseGroupClients;
use Response;

class EventsController extends Controller
{


    public function index()
    {
        $events = Events::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.events.index',[
            'active' => 'events',
            'title' => 'فعاليات وورش عمل',
            'events' => $events,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'فعاليات وورش عمل'
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token','photo']);
        $section = Events::create($data);
        if ($section) {
            if ($request->hasFile('photo') != '') {
                $data['photo'] = upload_image_without_resize('events/'.$section->id , $request->photo );
                $section->update($data);
            }

            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $sectionId)
    {
        $data = $request->except(['_token','photo']);
        $section = Events::find($sectionId);
        $update = Events::find($sectionId)->update($data);
        if ($update) {
            if ($request->photo != '') {
                if ($section->photo != '') {
                    delete_image('events/'.$sectionId , $section->photo);
                }
                $data['photo'] = upload_image_without_resize('events/'.$sectionId , $request->photo );
                $section->update($data);
            }
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($sectionId)
    {
        $course = Events::find($sectionId);
        if ($course->delete()) {
            delete_folder('uploads/events/'.$sectionId);
            return Response::json($sectionId);
        }
        return Response::json("false");
    }


    public function clients()
    {
        if (!userCan('clients_view') && !userCan('clients_view_call_center')) {
            return redirect()->route('admin.index')
                                ->with('faild',trans('common.youAreNotAuthorized'));
        }
        $reservations = CourseGroupClients::where('course_reservation_type','event');
        //filter by client
        if (isset($_GET['cellphone'])) {
            if ($_GET['cellphone'] != '') {
                $search_client_ids = Clients::where('cellphone',$_GET['cellphone'])->pluck('id')->toArray();
                $reservations = $reservations->whereIn('client_id',$search_client_ids);
            }
        }
        $title = 'عملاء الورش والفعاليات';
        if (isset($_GET['event_id'])) {
            if ($_GET['event_id'] != 'all') {
                $reservations = $reservations->where('course_id',$_GET['event_id'])->where('course_reservation_type','event');
                $event = Events::find($_GET['event_id']);
                $title = 'عملاء الورشة: '.$event['title'];
            }
        }
        $reservations = $reservations->orderBy('id','desc')->paginate(25);
        return view('AdminPanel.events.clients',[
            'active' => 'events',
            'title' => $title,
            'reservations' => $reservations->appends($_GET),
            'breadcrumbs' => [
                [
                    'url' => route('admin.events'),
                    'text' => 'الورش والفعاليات'
                ],
                [
                    'url' => '',
                    'text' => $title
                ]
            ]
        ]);
    }
    public function deleteReservation($ReservationId)
    {
        $Reservation = CourseGroupClients::find($ReservationId);
        if ($Reservation->delete()) {
            return Response::json($ReservationId);
        }
        return Response::json("false");
    }

}
