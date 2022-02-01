<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    use HasFactory;

    protected $primaryKey = 'idChat';
    protected $fillable = ['idChat','message','Session_idSession','User_idUser'];
    protected $guarded = [];
    protected $table = 'chat';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
