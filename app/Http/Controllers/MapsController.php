<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maps;
use App\Models\Session;
use App\Models\Sounds;
use App\Events\MapEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MapsController extends Controller
{
      public function upload(Request $request){
            
            $request->validate([
               'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048',
            ]);     
                $file = $request->file('file');
                $file_name = $file->getClientOriginalName();
                $file_name = time().'_'.$file_name;

                $file->move(public_path('/images'),$file_name);
            $gracz = Auth::user();
            $maps = $gracz->mapy()->create([
                  'name' => time().'_'.$request->file->getClientOriginalName(),
                  'path' => '/storage'.$file,
                  'Session_idSession' => $request->session,
            ]);
            broadcast(new MapEvent($maps,$gracz))->toOthers();
                return response()->json(['success'=>'File uploaded successfully.']);       
       }    
}
