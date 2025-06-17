<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login choice (Email or OTP)
    public function showLoginChoice()
    {
        return view('auth.login-choice');
    }

    // Alias (optional, for route('login.choice'))
    public function showLoginOptions()
    {
        return $this->showLoginChoice();
    }

    // Show the email/password login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login form POST (email/password)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('profile.index'));
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    // ======== OTP LOGIN FLOW ========

    // Show the mobile number entry form for OTP login
    public function showOtpLoginForm()
    {
        return view('auth.login-otp');
    }

    // Handle OTP send (from mobile number POST)
    public function sendOtp(Request $request)
    {
        $request->validate(['mobile' => 'required|digits:10']);
        $mobile = $request->input('mobile');
        $otp = rand(100000, 999999);
        session(['login_otp_mobile' => $mobile, 'login_otp_code' => $otp]);
        // TODO: Integrate with real SMS provider here (for demo, we show OTP onscreen)
        return redirect()->route('login.otp.verify')->with('success', "OTP sent! (for testing: $otp)");
    }

    // Show OTP verify form
    public function showOtpVerifyForm()
    {
        return view('auth.login-otp-verify');
    }

    // Handle OTP verification and login
    public function checkOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);
        if ($request->otp == session('login_otp_code')) {
            $user = \App\Models\User::where('phone', session('login_otp_mobile'))->first();
            if ($user) {
                Auth::login($user);
                session()->forget(['login_otp_mobile', 'login_otp_code']);
                return redirect()->route('profile.index')->with('success', 'Logged in successfully!');
            } else {
                return back()->with('error', 'No account with this mobile number!');
            }
        }
        return back()->with('error', 'Invalid OTP!');
    }
}
