<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CardsCharacters;

class Parameters extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'idParamiters';
    protected $fillable = ['idParamiters','name'];
    protected $table = 'parameters';


    public function card()
    {
            return $this->belongsToMany(CardsCharacters::class,'cardscharacters_has_parameters','parameters_idParamiters','CardsCharacters_idCardsCharacters')->withPivot('value');                                                               
    }
}
