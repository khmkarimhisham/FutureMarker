<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Auth;

class MessagesController extends Controller
{

    public function show($id)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $allMessages = Message::where('from_user_id', Auth::id())->orWhere('to_user_id', Auth::id())->get();

        $contacts = array();
        foreach ($allMessages as $message) {
            array_push($contacts, $message->other_user);
        }
        $active = null;
        $messages = null;
        if ($contacts) {
            $contacts = array_unique($contacts);
            $active = User::findOrFail($id);
            $messages = Message::where([['from_user_id', Auth::id()], ['to_user_id', $active['id']]])
                ->orWhere([['to_user_id', Auth::id()], ['from_user_id', $active['id']]])
                ->orderBy('created_at')->get();
        }
        $notifications = $user->notifications;
        return view('instructor/messages', ['user' => $user, 'contacts' => $contacts, 'active' => $active, 'messages' => $messages, 'notifications' => $notifications]);
    }
    public function index()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $allMessages = Message::where('from_user_id', Auth::id())->orWhere('to_user_id', Auth::id())->get();

        $i = 0;
        $contacts = array();
        foreach ($allMessages as $message) {
            array_push($contacts, $message->other_user);
        }
        $active = null;
        $messages = null;
        if ($contacts) {
            $contacts = array_unique($contacts);
            $active = $contacts[0];
            $messages = Message::where([['from_user_id', Auth::id()], ['to_user_id', $contacts[0]['id']]])
                ->orWhere([['to_user_id', Auth::id()], ['from_user_id', $active['id']]])
                ->orderBy('created_at')->get();
        }
        $notifications = $user->notifications;
        return view('instructor/messages', ['user' => $user, 'contacts' => $contacts, 'active' => $active, 'messages' => $messages, 'notifications' => $notifications]);
    }
    public function search()
    {
        $user_email = request('search');
        $contact = User::where('email', $user_email)->get();
        return redirect(route('instructor.message.show', $contact[0]['id']));

    }
    public function newMessage($id)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        if(request()->has('email')){
        $send_to = request('email');
        $contact = User::where('email', $send_to)->get();
        }else{
            $send_to = User::findOrFail($id);
        }
        $message = new Message;
        $message->toUser()->associate($contact[0]['id']);
        $message->fromUser()->associate($user['id']);
        $message->message_content = request('content');
        if (request()->has('uploadedfiles')) {
            $msg_attachment = md5(uniqid() . microtime());
            foreach (request('uploadedfiles') as $file) {
                $file->storeAs('public/messages/attachments/' . $msg_attachment, $file->getClientOriginalName());
            }
            $message->attachments_dir = 'public/messages/attachments/' . $msg_attachment;
        }else{
            $message->attachments_dir ='#####';
        }
        $message->save();
        return redirect(route('instructor.message.show', $contact[0]['id']));

    }
    public function send_message($id)
    {
        $userId = Auth::id();
        $send_to = User::findOrFail($id);
        $message = new Message;
        $message->toUser()->associate($send_to['id']);
        $message->fromUser()->associate($userId);
        $message->message_content = request('content');
        if (request()->has('uploadedfiles')) {
            $msg_attachment = md5(uniqid() . microtime());
            foreach (request('uploadedfiles') as $file) {
                $file->storeAs('public/messages/attachments/' . $msg_attachment, $file->getClientOriginalName());
            }
            $message->attachments_dir = 'public/messages/attachments/' . $msg_attachment;
        }else{
            $message->attachments_dir='####';
        }
        $message->save();
        return redirect(route('instructor.message.show',$send_to['id'] ));

    }

}
