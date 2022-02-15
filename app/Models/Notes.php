<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idNotes';
    protected $fillable = ['idNotes','Title','Date','Session_idSession'];
    protected $guarded = [];
    protected $table = 'notes';

    public function usernote()
    {
        return $this->belongsToMany(User::class,'user_has_notes','notes_idNotes','User_idUser')->withPivot('text');
    }
}
