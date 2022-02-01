<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameters;

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
}
