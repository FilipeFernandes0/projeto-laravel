<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function ancestors()
    {
        return $this->belongsToMany(Comment::class, 'comment_closures', 'descendant_id', 'ancestor_id')
                    ->withPivot('depth');
    }

    public function descendants()
    {
        return $this->belongsToMany(Comment::class, 'comment_closures', 'ancestor_id', 'descendant_id')
                    ->withPivot('depth');
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function team(){

        return $this->belongsTo(Team::class);
    }

    public function commentLikes(){

        return $this->hasMany(LikeComment::class);
    
        
    }


}
