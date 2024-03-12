<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'team_id'];


    public function team()
    {
        return $this->belongsTo(Team::class,'team_id', 'teams_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
