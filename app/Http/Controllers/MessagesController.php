<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;


class MessagesController extends Controller
{
    public function index($id)
    {
        $messages = Message::all();
        $userId = User::find($id)->name;

        return view('sellerchat', compact('messages', 'userId'));
    }

    public function store(Request $request)
    {
        // Store new message
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Trigger event to broadcast the new message to the receiver
        broadcast(new NewMessage($message))->toOthers();

        return response()->json(['status' => 'success']);
    }

    public function userMessages()
    {
        $user = auth()->user();
        $messages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('messages.user_messages', compact('messages'));
    }
}
