<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NGO extends Model
{
    protected $table = 'ngos';

    protected $fillable = [
        'name',
        'description',
        'email',
        'phone',
    ];

    public function needyPersons()
    {
        return $this->hasMany(NeedyPerson::class, 'ngo', 'name'); // assuming 'ngo' in needy_person stores NGO name
    }
} 