<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Parameters;
use App\Models\User;

class CardsCharacters extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'idCardsCharacters';
    protected $fillable = ['idCardsCharacters','User_idUser','name','height','weight','eyes_color','hair_color','detail','age','race', 'star','sex','CardsCharacters_User1'];
    protected $table = 'cardscharacters';


    public function parameters()
    {
            return $this->belongsToMany(Parameters::class,'cardscharacters_has_parameters','CardsCharacters_idCardsCharacters','Paramiters_idParamiters')->withPivot('value');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
