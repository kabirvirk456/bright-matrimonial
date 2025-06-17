<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Carbon\Carbon;

class ProfileTestController extends Controller
{
    public function index()
    {
        // Get 5 test profiles (IDs 40 to 44), eager load user
        $profiles = Profile::with('user')
            ->whereBetween('id', [40, 44])
            ->get();

        // Optional: Compute age if you store birth_date or dob in User/Profile
        foreach ($profiles as $profile) {
            $dob = $profile->birth_date ?? $profile->user->dob ?? null;
            if ($dob) {
                $profile->calculated_age = Carbon::parse($dob)->age;
            } else {
                $profile->calculated_age = null;
            }
        }

        return view('profile-test', compact('profiles'));
    }
}
