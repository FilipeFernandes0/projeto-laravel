<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['id','name'];


    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    
        
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'teams_favorites', 'favorite_id', 'team_id');
    }


}
