<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sounds;

class SoundsController extends Controller
{
    public function getSound()
    {
        $sound = Sounds::get();
        return response()->json($sound);
    }

    public function uploadMusic(Request $request){
        $request->validate([
              'file' => 'required|mimes:mp3|max:10240',
        ]);

        $file = $request->file('file');

        $file->move(public_path('/sounds'),$file);

        $fileUpload = new Sounds;
        $fileUpload->name = $request->file;
        $fileUpload->path = '/storage/' . $file;
        $fileUpload->save();

    
        return response()->json(['success'=>'File uploaded successfully.']);
  }
}
