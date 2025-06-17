{{-- resources/views/auth/register-otp-verify.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 px-2 py-8">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h1 class="text-2xl mb-6 font-bold text-center text-[#C63D0F]">Enter OTP</h1>
        @if(session('success'))
            <div class="mb-4 text-green-600 text-sm text-center">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 text-red-600 text-sm text-center">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('register.otp.check') }}">
            @csrf
            <input type="text" name="otp" placeholder="Enter OTP" required class="w-full mb-4 px-4 py-2 rounded border border-[#C63D0F] focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition text-lg text-center" maxlength="6" autofocus />
            <button type="submit" class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold py-2 rounded-lg transition text-lg shadow">
                Verify OTP
            </button>
        </form>
    </div>
</div>
@endsection
