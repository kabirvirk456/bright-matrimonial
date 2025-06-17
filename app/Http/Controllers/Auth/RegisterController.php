<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;

// Master models
use App\Models\Caste;
use App\Models\State;
use App\Models\City;
use App\Models\Religion;
use App\Models\MotherTongue;
use App\Models\Hobby;

class RegisterController extends Controller
{
    // STEP 1: Show Registration Form
    public function showRegistrationForm()
    {
        $castes = Caste::orderBy('name', 'asc')->pluck('name', 'id');
        $states = State::orderBy('name', 'asc')->pluck('name', 'id');
        $cities = City::orderBy('name', 'asc')->pluck('name', 'id');
        $religions = Religion::orderBy('name', 'asc')->pluck('name', 'id');
        $motherTongues = MotherTongue::orderBy('name', 'asc')->pluck('name', 'id');

        return view('auth.register', compact('castes', 'states', 'cities', 'religions', 'motherTongues'));
    }

    // STEP 1: Handle Registration Submission
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name'  => 'required|max:50',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|digits:10|unique:users,phone',
            'password'   => 'required|min:8|confirmed',
            'gender'     => 'required|in:male,female,other',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'gender'     => $request->gender,
        ]);

        Auth::login($user);

        return redirect()->route('register.profile');
    }

    // STEP 2: Show Profile Form
    public function showProfileForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $castes = Caste::orderBy('name', 'asc')->pluck('name', 'id');
        $states = State::orderBy('name', 'asc')->pluck('name', 'id');
        $cities = City::orderBy('name', 'asc')->pluck('name', 'id');
        $religions = Religion::orderBy('name', 'asc')->pluck('name', 'id');
        $motherTongues = MotherTongue::orderBy('name', 'asc')->pluck('name', 'id');
        $hobbies = Hobby::orderBy('name', 'asc')->pluck('name', 'id');

        return view('auth.register-profile', compact(
            'castes', 'states', 'cities', 'religions', 'motherTongues', 'hobbies'
        ));
    }

    // STEP 2: Handle Profile Form Submission (stores IDs, not names)
    public function saveProfile(Request $request)
    {
        $request->validate([
            'religion_id'      => 'required|exists:religions,id',
            'caste_id'         => 'required|exists:castes,id',
            'state_id'         => 'required|exists:states,id',
            'city_id'          => 'required|exists:cities,id',
            'mother_tongue_id' => 'required|exists:mother_tongues,id',
            'about'            => 'nullable|string|max:1000',
            'marital_status'   => 'nullable|string|max:20',
            'highest_qualification' => 'nullable|string|max:100',
            'company_position'      => 'nullable|string|max:100',
            'height'           => 'nullable|numeric',
            'weight'           => 'nullable|numeric',
            'hobby_id'         => 'nullable|exists:hobbies,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to complete your profile.');
        }

        // Save all dropdowns as IDs
        $profileData = [
            'about'                 => $request->about,
            'marital_status'        => $request->marital_status,
            'highest_qualification' => $request->highest_qualification,
            'company_position'      => $request->company_position,
            'height'                => $request->height,
            'weight'                => $request->weight,
            'hobby_id'              => $request->hobby_id,
            'caste_id'              => $request->caste_id,
            'religion_id'           => $request->religion_id,
            'city_id'               => $request->city_id,
            'state_id'              => $request->state_id,
            'mother_tongue_id'      => $request->mother_tongue_id,
        ];

        $profile = $user->profile ?: new Profile(['user_id' => $user->id]);
        $profile->fill($profileData);
        $profile->user_id = $user->id;
        $profile->save();

        return redirect()->route('profile.personal-info')->with('success', 'Registration complete! Please complete your profile.');
    }

    // (Optional) Registration by OTP methods
    public function showRegistrationOptions()
    {
        return view('auth.register-choice');
    }
    public function showOtpRegisterForm()
    {
        return view('auth.register-otp');
    }
    public function sendOtp(Request $request)
    {
        $request->validate(['mobile' => 'required|digits:10']);
        $mobile = $request->input('mobile');
        $otp = rand(100000, 999999);
        session(['otp_mobile' => $mobile, 'otp_code' => $otp]);
        return redirect()->route('register.otp.verify')->with('success', "OTP sent! (for testing: $otp)");
    }
    public function checkOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);
        if ($request->otp == session('otp_code')) {
            return redirect()->route('register.form')->with('otp_mobile', session('otp_mobile'));
        }
        return back()->with('error', 'Invalid OTP! Please try again.');
    }
    public function showOtpVerifyForm()
    {
        return view('auth.verify-otp');
        
    }
    
}
