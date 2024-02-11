<?php

namespace App\Http\Controllers;

use App\Service\ProfileService;


class FmcController extends Controller
{
    public $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }


    public function index()
    {
        $profile = $this->profileService->getById(session()->get('profile_id'));

        if ($profile->managed_club === NULL) {
            return redirect("/Profile/select-club");
        }

        return view("/Fmc/index");
    }
}
