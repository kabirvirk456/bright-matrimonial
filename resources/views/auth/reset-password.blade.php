{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-2 py-8">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl px-8 py-10">
        <h1 class="text-2xl font-bold text-center text-[#C63D0F] mb-6">Reset Password</h1>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold text-[#3B3738]">Email Address</label>
                <input id="email" class="w-full border border-[#C63D0F] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition"
                       type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
                @error('email')
                    <div class="mt-2 text-red-600 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold text-[#3B3738]">New Password</label>
                <input id="password" class="w-full border border-[#C63D0F] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition"
                       type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <div class="mt-2 text-red-600 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-1 font-semibold text-[#3B3738]">Confirm Password</label>
                <input id="password_confirmation" class="w-full border border-[#C63D0F] rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition"
                       type="password" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <div class="mt-2 text-red-600 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold py-2 rounded-lg transition mb-3 text-lg shadow">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
