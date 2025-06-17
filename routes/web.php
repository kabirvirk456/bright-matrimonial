<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileTestController;
use App\Models\Profile;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CasteController;

// DEBUG: Check session and auth
Route::get('/debug-session', function () {
    return [
        'auth_check' => auth()->check(),
        'user' => auth()->user()
    ];
});

// ==== PUBLIC HOMEPAGE ====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login/choice', function () {
    return view('auth.login-choice');
})->name('login.choice');

// ==== REGISTER/LOGIN CHOICE PAGES (PUBLIC) ====
Route::get('/register', [RegisterController::class, 'showRegistrationOptions'])->name('register.choice');
Route::get('/login', [LoginController::class, 'showLoginOptions'])->name('login.choice');
// Login with OTP (add a controller and view for this if you don't have yet)
Route::get('/login/otp', [LoginController::class, 'showOtpLoginForm'])->name('login.otp');
Route::post('/login/otp/send', [LoginController::class, 'sendOtp'])->name('login.otp.send');
Route::get('/login/otp/verify', [LoginController::class, 'showOtpVerifyForm'])->name('login.otp.verify');
Route::post('/login/otp/verify', [LoginController::class, 'checkOtp'])->name('login.otp.check');
// --- Login OTP routes ---
Route::get('/login/otp', [LoginController::class, 'showOtpLoginForm'])->name('login.otp');
Route::post('/login/otp/send', [LoginController::class, 'sendOtp'])->name('login.otp.send');
Route::get('/login/otp/verify', [LoginController::class, 'showOtpVerifyForm'])->name('login.otp.verify');
Route::post('/login/otp/verify', [LoginController::class, 'checkOtp'])->name('login.otp.check');

// ==== EMAIL REGISTRATION ====
Route::get('/register/email', [RegisterController::class, 'showRegistrationForm'])->name('register.email');
Route::post('/register/email', [RegisterController::class, 'register'])->name('register.submit');

// ==== OTP REGISTRATION ====
Route::get('/register/otp', [RegisterController::class, 'showOtpRegisterForm'])->name('register.otp');
Route::post('/register/otp/send', [RegisterController::class, 'sendOtp'])->name('register.otp.send');
Route::get('/register/otp/verify', [RegisterController::class, 'showOtpVerifyForm'])->name('register.otp.verify');
Route::post('/register/otp/verify', [RegisterController::class, 'checkOtp'])->name('register.otp.check');
// Add this to your routes/web.php if not present
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// After OTP, show regular form but with phone prefilled and readonly
Route::get('/register/form', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register/form', [RegisterController::class, 'register'])->name('register.form.submit');

// ==== LOGIN EMAIL/OTP ====
Route::get('/login/email', [LoginController::class, 'showLoginForm'])->name('login.email');
Route::post('/login/email', [LoginController::class, 'login'])->name('login.submit');
// If you have OTP login logic, uncomment and implement these routes
// Route::get('/login/otp', [LoginController::class, 'showOtpLoginForm'])->name('login.otp');
// Route::post('/login/otp/send', [LoginController::class, 'sendOtp'])->name('login.otp.send');
// Route::get('/login/otp/verify', [LoginController::class, 'showOtpVerifyForm'])->name('login.otp.verify');
// Route::post('/login/otp/verify', [LoginController::class, 'checkOtp'])->name('login.otp.check');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==== BROWSE MATCHES (public grid) ====
Route::get('/matches', [ProfileController::class, 'browse'])->name('matches.index');
Route::get('/api/cities', [CityController::class, 'byState']);
Route::get('/api/castes', [CasteController::class, 'byReligion']);
// ==== STATIC PAGES ====
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::view('/help', 'help')->name('help');
Route::view('/refund', 'refund')->name('refund');

// ==== PASSWORD RESET (FORGOT PASSWORD) ====
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    return back()->with('status', 'A password reset link has been sent to your email address (demo message).');
})->name('password.email');

// ==== AUTHENTICATED USER ROUTES ====
Route::middleware('auth')->group(function () {
    // REGISTRATION STEP 2: PROFILE DETAILS
    Route::get('/register/profile', [RegisterController::class, 'showProfileForm'])->name('register.profile');
    Route::post('/register/profile', [RegisterController::class, 'saveProfile'])->name('register.profile.save');

    // PROFILE DASHBOARD & SECTIONS
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/personal-info', [ProfileController::class, 'showPersonalInfo'])->name('profile.personal-info');
    Route::post('/profile/personal-info', [ProfileController::class, 'updatePersonalInfo'])->name('profile.personal-info.update');
    Route::get('/profile/education-career', [ProfileController::class, 'showEducationCareer'])->name('profile.education-career');
    Route::post('/profile/education-career', [ProfileController::class, 'updateEducationCareer'])->name('profile.education-career.update');
    Route::get('/profile/family-details', [ProfileController::class, 'showFamilyDetails'])->name('profile.family-details');
    Route::post('/profile/family-details', [ProfileController::class, 'updateFamilyDetails'])->name('profile.family-details.update');
    Route::get('/profile/lifestyle', [ProfileController::class, 'showLifestyle'])->name('profile.lifestyle');
    Route::post('/profile/lifestyle', [ProfileController::class, 'updateLifestyle'])->name('profile.lifestyle.update');
    Route::get('/profile/horoscope', [ProfileController::class, 'showHoroscope'])->name('profile.horoscope');
    Route::post('/profile/horoscope', [ProfileController::class, 'updateHoroscope'])->name('profile.horoscope.update');
    Route::get('/profile/likes', [ProfileController::class, 'showLikes'])->name('profile.likes');
    Route::post('/profile/likes', [ProfileController::class, 'updateLikes'])->name('profile.likes.update');
    Route::get('/profile/desired-partner', [ProfileController::class, 'showDesiredPartner'])->name('profile.desired-partner');
    Route::post('/profile/desired-partner', [ProfileController::class, 'updateDesiredPartner'])->name('profile.desired-partner.update');
    Route::get('/profile/questions', function () {
        return view('profile.questions');
    })->name('profile.questions');
    Route::post('/profile/questions', [ProfileController::class, 'saveQuestions'])->name('profile.saveQuestions');

    // Profile photo upload
Route::post('/profile/photo/upload', [ProfileController::class, 'uploadPhoto'])->name('profile.photo.upload');
  // For uploading selfie photo (POST)
Route::post('/profile/upload-selfie', [ProfileController::class, 'uploadSelfie'])->name('profile.upload.selfie');
Route::post('/profile/upload-selfie', [ProfileController::class, 'saveSelfie'])->name('profile.upload.selfie');
// For verifying photo (POST) (already there? If not, add)
Route::post('/profile/verify-photo', [ProfileController::class, 'verifyPhoto'])->name('profile.verify.photo');  
Route::post('/profile/selfie-upload', [ProfileController::class, 'saveSelfie'])->name('profile.selfie.upload');

    Route::post('/profile/verify-photo', [ProfileController::class, 'verifyPhoto'])->name('profile.verify.photo');

    // AWS Rekognition/Compare Faces DEV
    Route::get('/compare-faces', [ProfileController::class, 'showCompareForm'])->name('compare.faces.form');
    Route::post('/compare-faces', [ProfileController::class, 'compareFaces'])->name('compare.faces');
    Route::get('/test-rekognition', [ProfileController::class, 'testRekognition']);

    // MATCH/INTEREST
    Route::post('/matches/send-request/{id}', [MatchController::class, 'sendRequest'])->name('matches.sendRequest');
    Route::get('/interests/sent', [MatchController::class, 'sentInterests'])->name('interests.sent');
    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
    Route::get('/interests/received', [MatchController::class, 'receivedInterests'])->name('interests.received');
});

// Test Profiles
Route::get('/profile-test', [ProfileTestController::class, 'index']);

// ==== PUBLIC PROFILE VIEW (ALWAYS KEEP LAST!) ====
Route::get('/profile/{id}', [ProfileController::class, 'view'])->name('profile.view');
