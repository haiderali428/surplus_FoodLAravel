<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NGOController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        // Get unique NGO names from needy_person table for the logged-in user
        $ngos = \App\Models\NeedyPerson::where('user_id', $userId)->select('ngo')->distinct()->pluck('ngo');
        $ngosWithPersons = [];
        foreach ($ngos as $ngoName) {
            $needyPersons = \App\Models\NeedyPerson::with('user')->where('ngo', $ngoName)->where('user_id', $userId)->get();
            $ngosWithPersons[] = [
                'name' => $ngoName,
                'needyPersons' => $needyPersons
            ];
        }
        return view('NGO', compact('ngosWithPersons'));
    }

    public function showNeedyPersons($ngoId)
    {
        $ngo = \App\Models\NGO::with(['needyPersons.user'])->findOrFail($ngoId);
        $needyPersons = $ngo->needyPersons;
        return view('NGO.needy_persons', compact('ngo', 'needyPersons'));
    }

    public function showByName($ngoName)
    {
        $needyPersons = \App\Models\NeedyPerson::with('user')->where('ngo', $ngoName)->get();
        return view('NGO.needy_persons', compact('ngoName', 'needyPersons'));
    }
} 