<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    protected $guarded = [];

    


    public function team(){

        return $this->belongsTo(Team::class,'team_id', 'teams_id');

    }
    public function competition(){

        return $this->belongsTo(Competition::class,'competition_id', 'competitions_id');

    }


}
