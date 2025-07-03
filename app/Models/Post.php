<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'add_donation'; // or whatever your actual table is
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'item_name',
        'quantity',
        'expire_date',
        'category',
        'description',
        'image',
        'post_type',
        'created_at',
        'status',
    ];

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class, 'post_id')->where('post_type', 'simple_post');
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function requests()
    {
        return $this->hasMany(\App\Models\RequestDonation::class, 'donation_post_id');
    }
} 