<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function area(){

    return $this->belongsTo(Area::class, 'area_id', 'areas_id');

    
}

    public function seasons(){

    return $this->hasMany(Season::class);

    
}
public function matches(){

    return $this->hasMany(GameMatch::class);

    
}
public function standings(){

    return $this->hasMany(Standing::class);

    
}

public function teams(){

    return $this->hasMany(Team::class);

    
}
}


