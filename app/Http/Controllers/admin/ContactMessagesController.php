<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessages;
use Response;

class ContactMessagesController extends Controller
{
    public function index()
    {
        $messages = ContactMessages::orderBy('status', 'asc')->orderByDesc('created_at')->paginate(20);
        return view('AdminPanel.contactMessages.index', [
            'active' => 'contactMessages',
            'title' => 'رسائل اتصل بنا',
            'messages' => $messages,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'رسائل اتصل بنا'
                ]
            ]
        ]);
    }

    public function details($id)
    {
        $message = ContactMessages::find($id);
        $message->update(['status' => '1']);
        if ($message == '') {
            return redirect()->route('admin.contactmessages');
        }

        return view('AdminPanel.contactMessages.details', [
            'active' => 'contactMessages',
            'title' => 'رسائل اتصل بنا',
            'message' => $message,
            'breadcrumbs' => [
                [
                    'url' => route('admin.contactmessages'),
                    'text' => 'رسائل اتصل بنا'
                ],
                [
                    'url' => '',
                    'text' => 'تفاصيل الرسالة'
                ]
            ]
        ]);
    }

    public function delete($id)
    {
        $message = ContactMessages::find($id);
        if ($message->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
