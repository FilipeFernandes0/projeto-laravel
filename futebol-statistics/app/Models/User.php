<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function favorites(){

        return $this->hasMany(Favorite::class);
    
        
    }

    public function comments(){

        return $this->hasMany(Comment::class);
    
        
    }

    public function likes(){

        return $this->hasMany(Like::class);
    
        
    }

    public function hasLikedTeam(Team $team)
    {
        return $this->likes()->where('team_id', $team->teams_id)->exists();
    }

    public function removeLikeFromTeam(Team $team)
    {
        $this->likes()->where('team_id', $team->teams_id)->delete();
    }

    public function likesCount(Team $team)
    {
        return $this->likes()->where('team_id', $team->teams_id)->count();
    }

    public function hasLikedComment(Comment $comment)
    {
        return $this->commentLikes()->where('comment_id', $comment->id)->exists();
    }

    public function removeLikeFromComment(Comment $comment)
    {
        $this->commentLikes()->where('comment_id', $comment->id)->delete();
    }

    public function likesCommentCount(Comment $comment)
    {
        return $this->commentLikes()->where('comment_id', $comment->id)->count();
    }

    public function commentLikes(){

        return $this->hasMany(LikeComment::class);
    
        
    }

}
