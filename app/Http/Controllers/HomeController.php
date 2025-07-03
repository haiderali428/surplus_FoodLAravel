<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Example: Fetch these from DB in real app
        $stats = [
            'meals_provided' => 179000000,
            'pounds_rescued' => 100000000,
            'volunteers' => 50000,
            'food_donors' => 12000,
        ];
        return view('home', compact('stats'));
    }
} 