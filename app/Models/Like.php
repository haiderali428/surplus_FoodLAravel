<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'post_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // No direct post() relationship due to post_type polymorphism
}
