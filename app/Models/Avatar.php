<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Avatar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idAvatar';
    protected $fillable = ['idAvatar','name','path','topcord','leftcord','User_idUser'];
    protected $guarded = [];
    protected $table = 'avatar';

    public function użyt()
    {
        return $this->belongsTo(User::class);
    }
}
