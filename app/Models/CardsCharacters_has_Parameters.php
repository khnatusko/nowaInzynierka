<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardsCharacters_has_Parameters extends Model
{
    use HasFactory;

    protected $primaryKey = 'Parameters_idParamiters';
    protected $fillable = ['CardsCharacters_idCardsCharacters','Parameters_idParamiters','value'];
    protected $guarded = [];
    protected $table = 'cardscharacters_has_parameters';
}
