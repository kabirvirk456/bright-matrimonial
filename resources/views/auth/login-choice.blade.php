@extends('layouts.guest')
@section('content')
<div class="min-h-screen flex items-center justify-center px-2 md:px-8 bg-gradient-to-br from-[#FFF3E6] via-[#F4E6E7] to-[#E7D8D6] relative">
    <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" viewBox="0 0 1600 900" fill="none">
        <path d="M 0 500 Q 400 700 800 500 Q 1200 300 1600 500 L 1600 900 L 0 900 Z"
            fill="#FFF056" fill-opacity="0.12"/>
        <path d="M 0 200 Q 700 300 1600 100" stroke="#B83240" stroke-width="2" fill="none" opacity="0.07"/>
        <path d="M 0 700 Q 600 800 1600 850" stroke="#C63D0F" stroke-width="2" fill="none" opacity="0.09"/>
    </svg>
    <div class="relative z-10 w-full max-w-2xl bg-white rounded-3xl shadow-2xl flex flex-col items-center justify-center px-10 py-16">
        <img src="/images/logo.png" alt="Bright Matrimonial" class="h-12 mb-4" />
        <h2 class="text-2xl font-bold mb-4 text-[#C63D0F] text-center">Login</h2>
        <div class="w-full flex flex-col gap-5 mt-4">
            <a href="{{ route('login.email') }}" class="bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-semibold rounded-xl px-6 py-3 shadow text-lg text-center transition">Login with Email</a>
            <a href="{{ route('login.otp') }}" class="bg-[#FFF056] hover:bg-[#C63D0F] text-[#3B3738] hover:text-white font-semibold rounded-xl px-6 py-3 shadow text-lg text-center transition">Login with Mobile OTP</a>
        </div>
        <div class="mt-6 text-center text-sm">
            <span class="text-gray-600">New to Bright Matrimonial?</span>
            <a href="{{ route('register.choice') }}" class="ml-1 text-[#C63D0F] font-bold hover:underline">Register Free</a>
        </div>
    </div>
</div>
@endsection
