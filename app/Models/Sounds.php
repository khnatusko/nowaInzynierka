<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maps;

class Sounds extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idSounds';
    protected $fillable = ['idSounds','name', 'path'];

    protected $table = 'sounds';

    public function sounds()
    {
        return $this->belongsTo(Maps::class);
    }
}
