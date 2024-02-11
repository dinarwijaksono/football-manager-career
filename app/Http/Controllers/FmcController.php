<?php

namespace App\Http\Controllers;

use App\Service\ProfileService;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

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

        if (isNull($profile->managed_club)) {
            return redirect("/Profile/select-club");
        }

        return "Halaman fmc/index";
    }
}
