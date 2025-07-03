<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimplePost extends Model
{
    protected $table = 'simple_post';

    protected $fillable = [
        'user_id',
        'post',
        'image_post',
        'video_post',
        'post_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id')->where('post_type', 'simple_post');
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
