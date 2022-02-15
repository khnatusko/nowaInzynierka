<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NotesEvent;
use App\Models\Notes;
use App\Models\User_has_Notes;

class NotesController extends Controller
{
    public function createnote(Request $request)
    {
        $notes = Notes::create([
            'Title' => $request->title,
            'Date' => $request->date,
            'text' => $request->text,
            'Session_idSession' => $request->session,
            'User_idUser' => Auth::id(),
        ]);

        $user = Auth::id();
        $text = $request->text;

        $notes->usernote()->attach($user,['text'=>$text]);
               

        return response()->json([
            'success' => true,
            'status_code'=>200,
            'message' => 'Notes successfully add!'
        ]);
    }

    public function getNote()
    {
        //return Notes::with('usernote')->where('User_idUser','=',Auth::id())->get();
        
        //  return Notes::whereHas('usernote', function($q){
        //      $q->where('User_idUser','=',Auth::id());
        //  })->get();

        //return Notes::with('usernote')->get();

        return User_has_Notes::where('User_idUser','=',Auth::id())->get();
    }
}
