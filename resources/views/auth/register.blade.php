@extends('layouts.guest')
@section('content')
<div class="min-h-screen flex items-center justify-center px-2 md:px-8 bg-gradient-to-br from-[#FFF3E6] via-[#F4E6E7] to-[#E7D8D6] relative">

    {{-- Background SVG Waves --}}
    <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" viewBox="0 0 1600 900" fill="none">
        <path d="M 0 500 Q 400 700 800 500 Q 1200 300 1600 500 L 1600 900 L 0 900 Z"
              fill="#FFF056" fill-opacity="0.11"/>
        <path d="M 0 200 Q 700 300 1600 100" stroke="#B83240" stroke-width="2" fill="none" opacity="0.07"/>
        <path d="M 0 700 Q 600 800 1600 850" stroke="#C63D0F" stroke-width="2" fill="none" opacity="0.09"/>
    </svg>

    <div class="relative z-10 w-full max-w-5xl bg-white rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
        {{-- Left Panel --}}
        <div class="hidden md:flex flex-col justify-between items-center w-1/2 py-12 px-6 bg-gradient-to-b from-[#C63D0F] to-[#FFF056] text-white">
            <div class="flex flex-col items-center gap-3">
                <img src="/images/logo.png" alt="Bright Matrimonial" class="h-16">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-extrabold text-[#FFF056] tracking-tight">BRIGHT</span>
                    <span class="text-xl font-bold text-white">MATRIMONIAL</span>
                </div>
                <div class="text-xs text-[#3B3738] font-medium mt-1">
                    Yaha Rishte Bante Nahi, Tikte Hai
                </div>
                <h2 class="text-3xl font-bold mt-8 drop-shadow-lg">Welcome</h2>
                <p class="text-lg text-center mt-2 text-white/90">
                    Join Bright Matrimonial and start your journey to finding your perfect match today!
                </p>
            </div>
            <a href="{{ route('login.choice') }}" class="w-full mt-8">
                <button class="bg-white text-[#C63D0F] font-semibold rounded-full px-8 py-2 shadow transition hover:bg-[#FFF056] hover:text-[#3B3738] w-full">
                    Login
                </button>
            </a>
        </div>

        {{-- Right Panel: Registration Form --}}
        <div class="flex-1 py-10 px-6 md:px-10">
            <h2 class="text-2xl font-bold mb-6 text-[#C63D0F] text-center tracking-tight">Create Your Account</h2>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <input type="text" name="first_name" placeholder="First Name *" class="rounded-lg border border-[#C63D0F] px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" value="{{ old('first_name') }}" required>
                <input type="text" name="last_name" placeholder="Last Name *" class="rounded-lg border border-[#C63D0F] px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" value="{{ old('last_name') }}" required>
                <input type="email" name="email" placeholder="Email *" class="rounded-lg border border-[#C63D0F] px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition col-span-1" value="{{ old('email') }}" required>
                <input type="text" name="phone" placeholder="Phone *" class="rounded-lg border border-[#C63D0F] px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition col-span-1" value="{{ old('phone', session('otp_mobile')) }}" required {{ session('otp_mobile') ? 'readonly' : '' }}>

                <input type="password" name="password" placeholder="Password *" class="rounded-lg border border-[#C63D0F] px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition col-span-1" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password *" class="rounded-lg border border-[#C63D0F] px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition col-span-1" required>
                
                {{-- Gender --}}
                <div class="flex items-center space-x-4 col-span-2 mt-2">
                    <label class="font-medium text-gray-600">Gender:</label>
                    <label class="flex items-center"><input type="radio" name="gender" value="male" class="mr-2 accent-[#C63D0F]" {{ old('gender') == 'male' ? 'checked' : '' }}> Male</label>
                    <label class="flex items-center"><input type="radio" name="gender" value="female" class="mr-2 accent-[#C63D0F]" {{ old('gender') == 'female' ? 'checked' : '' }}> Female</label>
                    <label class="flex items-center"><input type="radio" name="gender" value="other" class="mr-2 accent-[#C63D0F]" {{ old('gender') == 'other' ? 'checked' : '' }}> Other</label>
                </div>

                <div class="col-span-2 mt-4">
                    <button type="submit" class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold rounded-full py-3 text-lg shadow transition">
                        Register Free
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center text-sm">
                <span class="text-gray-600">Already have an account?</span>
                <a href="{{ route('login.choice') }}" class="ml-1 text-[#C63D0F] font-bold hover:underline">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection
