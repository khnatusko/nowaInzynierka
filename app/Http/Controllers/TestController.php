<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maps;
use App\Models\Avatar;
use App\Models\Session;
use App\Events\MapEvent;
use App\Events\MoveEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Session $idSession)
    {
        return view('test',['idSession' => $idSession]);
      }

    public function fetchAllMap()
    {
        return Maps::get();
    }

    public function fetchAllAvatar()
    {
        return Avatar::get();
    }

    public function sendMap(Request $request)
    {  
             $file = $request->file('file');
             $file_name = $file->getClientOriginalName();
             $file_name = time().'_'.$file_name;

             $file->move(public_path('/images'),$file_name);


         $sesja = Session::findOrFail(1)->get();
         $maps = $sesja->session_maps()->create([
               'name' => time().'_'.$request->input('file')->getClientOriginalName(),
               'path' => '/storage'.$file,
               'Session_idSession' => $request->session,
         ]); 
         broadcast(new MapEvent($maps,$sesja))->toOthers();
         return response()->json(['success'=>'File uploaded successfully.']);     
    }

    public function destroy(Request $request, $idMaps)
    {
       $upload = Maps::findOrFail($idMaps);
       $upload->delete();
        $currentPhoto = $upload->photo;  // by this code controller find currentPhoto in file of framework
        $userPhoto = public_path('/images').$currentPhoto;  // delete image in public(file of framework)
        if(file_exists($userPhoto)) {
           @unlink($userPhoto);
        }
        return response()->json('Zdjęcie usunięte');
    }


    public function createAvatar(Request $request)
    {
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file_name = time().'_'.$file_name;
        $file->move(public_path('/images'),$file_name);


        $user = Auth::user();
        $avataricon = $user->icons()->create([
            'name' => time().'_'.$request->file->getClientOriginalName(),
            'path' => '/storage'.$file,
            'topcord' => $request->topcord,
            'leftcord' => $request->leftcord,
        ]); 
        //broadcast(new MoveEvent($avataricon,$user))->toOthers();
        return response()->json(['success'=>'File uploaded successfully.']);    
    }

    public function updateAvatar(Request $request, $idAvatar)
    {
        // $avataricon = Avatar::find($idAvatar);
        // $avataricon->update($request->all());
        $text = $request->text;
        broadcast(new MoveAvatar($text,$user))->toOthers();
        return response()->json('Avatar updated!');
    }
}
