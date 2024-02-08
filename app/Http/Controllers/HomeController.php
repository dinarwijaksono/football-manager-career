<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('/Home/index');
    }


    public function newProfile()
    {
        return view('/Home/new-profile');
    }


    public function selectClub()
    {
        return view('/Home/select-club');
    }
}
