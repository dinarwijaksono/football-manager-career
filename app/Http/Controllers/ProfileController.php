<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function selectClub()
    {
        return view('Profile/select-club');
    }

    public function loadProfile()
    {
        return view('Profile/load-profile');
    }
}
