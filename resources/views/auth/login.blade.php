@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center px-2 md:px-8 bg-gradient-to-br from-[#FFF3E6] via-[#F4E6E7] to-[#E7D8D6] relative">
    {{-- Background curvy SVG layer --}}
    <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" viewBox="0 0 1600 900" fill="none">
        <path d="M 0 500 Q 400 700 800 500 Q 1200 300 1600 500 L 1600 900 L 0 900 Z"
              fill="#FFF056" fill-opacity="0.12"/>
        <path d="M 0 200 Q 700 300 1600 100" stroke="#B83240" stroke-width="2" fill="none" opacity="0.07"/>
        <path d="M 0 700 Q 600 800 1600 850" stroke="#C63D0F" stroke-width="2" fill="none" opacity="0.09"/>
    </svg>

    <div class="relative z-10 w-full max-w-4xl bg-white rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
        {{-- Left: Login Form --}}
        <div class="w-full md:w-1/2 flex flex-col justify-center px-8 py-12 md:px-10">
            <!-- Logo & Brand -->
            <div class="flex flex-col items-center mb-6">
                <img src="/images/logo.png" alt="Bright Matrimonial" class="h-14 mb-3" />
                <div class="flex items-baseline gap-1">
                    <span class="text-2xl font-extrabold text-[#FFF056] tracking-tight">BRIGHT</span>
                    <span class="text-xl font-bold text-[#C63D0F]">MATRIMONIAL</span>
                </div>
                <div class="text-xs text-[#889B89] font-medium tracking-wide mt-1">
                    Yaha Rishte Bante Nahi, Tikte Hai
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-2xl font-bold text-[#C63D0F] text-center mb-3 tracking-tight">Login to Your Account</h1>
            <p class="text-center text-gray-500 text-sm mb-6">
                Welcome back! Connect and find your perfect match.
            </p>

            <!-- Error Handling -->
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.submit') }}" autocomplete="off">
                @csrf
                <div class="mb-5">
                    <label class="block mb-1 font-semibold text-[#3B3738]" for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-[#C63D0F] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition"
                        required autofocus>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-semibold text-[#3B3738]" for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-[#C63D0F] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition"
                        required>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="remember" class="accent-[#C63D0F] rounded" />
                        Remember Me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-xs text-[#C63D0F] hover:underline font-semibold">Forgot Password?</a>
                </div>
                <button type="submit" class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold py-2 rounded-lg transition mb-3 text-lg shadow">
                    Login
                </button>
            </form>
            <div class="mt-6 text-center text-sm">
                <span class="text-gray-600">New to Bright Matrimonial?</span>
                <a href="{{ route('register.choice') }}" class="ml-1 text-[#C63D0F] font-bold hover:underline">Register Free</a>
            </div>
        </div>

        {{-- Right: Image --}}
        <div class="w-full md:w-1/2 bg-gradient-to-tr from-[#FFF3E6] via-[#B83240]/10 to-[#C63D0F]/30 flex items-center justify-center">
            <img src="/images/s4.jpg" alt="Login Visual" class="h-[380px] md:h-[520px] w-auto object-cover rounded-none md:rounded-ss-none md:rounded-se-3xl md:rounded-es-none md:rounded-ee-3xl shadow-xl">
        </div>
    </div>
</div>
@endsection
