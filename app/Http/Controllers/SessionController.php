<?php

namespace App\Http\Controllers;
use App\Models\Session;

use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('game');
    }

    public function start(Session $idSession)
    {
        return view('sessiongame',['idSession' => $idSession]);
    }

    public function allSessions()
    {
        $sessions = Session::all();

        $allSessionsWithSessionCount = [
            'session' => $sessions,
            'sessions_count' => $sessions->count()
        ];

        return $allSessionsWithSessionCount;
    }

    public function getSession()
    {
        $session = Session::get();
        return response()->json($session);
    }

    public function creategame(Request $request)
    {
         
        
            $games = Session::create([
                'title'                 => $request->title,
                'gametime'              => $request->gametime,
                'User_idUser'           => $request->user,
                'User_idUser'           => $request->user1,
                'User_idUser'           => $request->user2,
                'User_idUser'           => $request->user3,
                

            ]);
               
            $user = $request->user;
            $user1 = $request->user1;
            $user2 = $request->user2;
            $user3 = $request->user3;
            $games->users()->attach([$user,$user1,$user2,$user3]);
               
     
               return response()->json([
                'success' => true,
                'status_code'=>200,
                'message' => 'Game successfully add!'
            ]);

    
            

    
            
        }
}
