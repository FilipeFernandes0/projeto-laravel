<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comment_id'];
    protected $table = 'likes_comments';



    public function comments()
    {
        return $this->belongsTo(Comment::class,'comment_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
