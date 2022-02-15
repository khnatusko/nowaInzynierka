<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Chat;
use App\Models\CardsCharacters;
use App\Models\Notes;
use App\Models\Avatar;
use App\Models\Maps;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'idUser';
    protected $fillable = ['idUser','name','surname','login','password','email','nick','role'];
    protected $table = 'user';

    protected $hidden = [
        'remember_token',
    ];

    protected $guarded = [];
 
    public function messages()
    {
        return $this->hasMany(Chat::class);
    }

    public function cards()
    {
        return $this->hasMany(CardsCharacters::class);
    }

    public function notes()
    {
        return $this->belongsToMany(Notes::class,'user_has_notes','User_idUser','notes_idNotes')->withPivot('text');
    }

    public function icons()
    {
        return $this->hasMany(Avatar::class);
    }

    public function mapy()
    {
        return $this->hasMany(Maps::class);
    }
}
