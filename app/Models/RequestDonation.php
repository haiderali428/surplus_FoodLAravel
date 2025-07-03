<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestDonation extends Model
{
    protected $table = 'reqeust_donation';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'donation_post_id');
    }
}
