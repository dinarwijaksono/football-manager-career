<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function selectClub()
    {
        return view('Profile/select-club');
    }
}
