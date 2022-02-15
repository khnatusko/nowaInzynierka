<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameters;
use App\Models\CardsCharacters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class ParametersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('parameters');
    }

    public function createparameters(Request $request)
    {
         
    $form = $request->get('myCard');
    if ($forma = $request->get('myArray')){
    foreach ($forma as $valuee) {
        $parameters = Parameters::create([
            'name' => $valuee['name'],
            'value' => $valuee['value'],
            'CardsCharacters_idCardsCharacters' => $form,
        ]);
    
           $card = $form;
           $value = $valuee['value'];
           $parameters->card()->attach($card,['value'=>$value]);
        }
    
    }else{
        return response()->json(['message'=>'Lol, beka z Ciebie']);
    }
 
           return response()->json([
            'success' => true,
            'status_code'=>200,
            'message' => 'Parameters successfully add!'
        ]);
    
    }

    public function cardparameters()
    {
        return view('cardparameters');
    }

    public function getParameters()
    {
        $usercard = CardsCharacters::where('User_idUser','=',Auth::id())->get();

        //  $parametrcard = DB::table('parameters')
        //                      ->join('cardscharacters_has_parameters', 'parameters.idParamiters', '=', 'cardscharacters_has_parameters.Parameters_idParamiters')
        //                      ->get();

        $parametrcard = DB::table('cardscharacters_has_parameters')
                            ->join('parameters', 'cardscharacters_has_parameters.Parameters_idParamiters', '=', 'parameters.idParamiters')
                            ->join('cardscharacters', 'cardscharacters_has_parameters.CardsCharacters_idCardsCharacters', '=', 'cardscharacters.idCardsCharacters')
                            ->where('cardscharacters.User_idUser','=',Auth::id())
                            ->select('parameters.name', 'cardscharacters_has_parameters.value', 'cardscharacters.idCardsCharacters')
                            ->get();
        
        //$parametrcard = Parameters::with('card')->get();

        return response()->json($parametrcard);                     
    }

}
