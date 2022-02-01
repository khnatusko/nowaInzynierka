<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Session;

class Maps extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idMaps';
    protected $fillable = ['idMaps','name', 'path', 'Session_idSession'];

    protected $table = 'maps';

    public function maps()
    {
        return $this->belongsTo(Session::class);
    }

}
