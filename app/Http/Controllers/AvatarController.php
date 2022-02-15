<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;

class AvatarController extends Controller
{
    public function updateCordAvatar(Request $request, $idAvatar)
    {
        $avatar = Avatar::find($idAvatar);
        $avatar->update(
            $request->topCord,
            $request->leftCord,
    );
        return response()->json('Avatar updated!');
    }
}
