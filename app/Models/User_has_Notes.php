<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_Notes extends Model
{
    use HasFactory;

    protected $primaryKey = 'Notes_idNotes';
    protected $fillable = ['User_idUser','Notes_idNotes','text'];
    protected $guarded = [];
    protected $table = 'user_has_notes';
}
