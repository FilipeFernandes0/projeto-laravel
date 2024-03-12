<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'teams_id'; 

    public function standings(){
        return $this->hasMany(Standing::class);
    }

    public function homeMatches()
    {
        return $this->hasMany(GameMatch::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(GameMatch::class, 'away_team_id');
    }

    public function members()
    {
        return $this->hasMany(Person::class);
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competitions_id');
    }

    public function favorites()
{
    return $this->belongsToMany(Favorite::class, 'teams_favorites', 'team_id', 'favorite_id');
}

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }



    

}
