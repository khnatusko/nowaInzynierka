<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardsCharacters;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('card');
    }

    public function createcard(Request $request)
    {
        $card = CardsCharacters::create([
            'name'                  => $request->name,
            'height'                => $request->height,
            'weight'                => $request->weight,
            'eyes_color'            => $request->eyes_color,
            'hair_color'            => $request->hair_color,
            'detail'                => $request->detail,
            'age'                   => $request->age,
            'race'                  => $request->race,
            'star'                  => $request->star,
            'sex'                   => $request->sex,
            'User_idUser'           => Auth::id(),
        ]);
        return ['status' => 'Card create!'];
    }

    public function getCards(Request $request)
    {
        $cards = CardsCharacters::get();
        
        return response()->json($cards);
    }

    public function searchcard(Request $request){
        
        $card = CardsCharacters::where('idCardsCharacters','LIKE','%'.$request->keyword.'%')->get();

        return response()->json($card);
    }

}
