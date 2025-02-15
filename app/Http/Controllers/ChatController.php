<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatEvent;
use App\Models\Chat;
use App\Models\Session;

class ChatController extends Controller
{
    //Add the below functions
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function fetchMessages(Session $idSession)
    {
        return Chat::with('user')->get();
    }

    public function sendMessage(Request $request,Session $idSession)
    {
        $user = Auth::user();
        $chat = $user->messages()->create([
            'message' => $request->input('message'),
            'Session_idSession' => $request->$idSession,
            
        ]);
        broadcast(new ChatEvent($chat,$user))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
