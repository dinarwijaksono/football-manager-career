<?php

namespace App\Http\Controllers;

use App\Service\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function selectClub()
    {
        $profile = $this->profileService->getById(session()->get('profile_id'));
        if ($profile->managed_club !== NULL) {
            return redirect("/FMC");
        }

        return view('Profile/select-club');
    }

    public function loadProfile()
    {
        return view('Profile/load-profile');
    }
}
