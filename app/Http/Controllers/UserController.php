<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CardsCharacters;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('userlist');
    }

    public function getUsers()
    {
        $user = User::get();
        return response()->json($user);
    }

    public function allUsers()
    {
        $users = User::all();

        $allUsersWithUserCount = [
            'user' => $users,
            'users_count' => $users->count()
        ];

        return $allUsersWithUserCount;
    }

    public function listuser(){
        $users = User::orderBy('idUser', 'asc')->paginate(5);
        return response()->json($users);
    }

    public function searchuser(Request $request){
        
        $user = User::where('name','LIKE','%'.$request->keyword.'%')->get();

        return response()->json($user);
    }

    public function getCardsUser(){

        return CardsCharacters::where('User_idUser','=',Auth::id())->get();
    }

    

}
