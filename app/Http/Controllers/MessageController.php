<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\MessageSent;

class MessageController extends Controller
{
    public function show(Message $message)
    {
        return view('message.show', compact('message'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'to_user_id' => 'required|exists:users,id',
        ]);

        $message = Message::create([
            'subject' => $request->subject,
            'body' => $request->body,
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $request->to_user_id,
        ]);
        $user = User::find($request->to_user_id);
        $user->notify(new MessageSent($message));
        $request->session()->flash('flash.banner', 'Mensaje enviado');
        $request->session()->flash('flash.bannerStyle', 'success');
        return redirect()->back();
    }
}
