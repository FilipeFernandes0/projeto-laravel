<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMatch extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id', 'teams_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id', 'teams_id');
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competitions_id');
    }

}

