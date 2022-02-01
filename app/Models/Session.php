<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Chat;
use App\Models\Maps;

class Session extends Model
{
    use Notifiable, HasApiTokens;
    
    public $timestamps = false;
    protected $primaryKey = 'idSession';
    protected $fillable = ['idSession','title','gametime'];

    protected $table = 'session';

    public function users()
    {
        return $this->belongsToMany(User::class,'user_has_session','Session_idSession','User_idUser');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function session_maps()
    {
        return $this->hasMany(Maps::class);
    }
}
