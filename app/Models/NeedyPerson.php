<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeedyPerson extends Model
{
    protected $table = 'needy_person';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'cnic_front',
        'cnic_back',
        'ngo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ngo()
    {
        return $this->belongsTo(NGO::class, 'ngo', 'name'); // 'ngo' in needy_person stores NGO name
    }
} 