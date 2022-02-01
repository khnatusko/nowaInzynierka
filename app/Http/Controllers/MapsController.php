<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maps;
use App\Models\Session;
use App\Models\Sounds;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MapsController extends Controller
{
    
    
      public function upload(Request $request){
            
            $request->validate([
               'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048',
               //'Session_idSession' => 'required',
            ]);
    
           
                $file = $request->file('file');
                $file_name = $file->getClientOriginalName();
                $file_name = time().'_'.$file_name;

                $file->move(public_path('/images'),$file_name);
                
                $session = $request->session;
                $fileUpload = new Maps;
                
                $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
                $fileUpload->path = '/storage/' . $file;
                $fileUpload->Session_idSession = Auth::id();
                $fileUpload->save();
                Log::info($session);
    
                return response()->json(['success'=>'File uploaded successfully.']);
            
       }

       
}
