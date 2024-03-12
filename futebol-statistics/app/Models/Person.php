<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'persons'; 
    
    public function team()
    {
        return $this->belongsTo(Team::class,'team_id', 'teams_id');
    }
}
