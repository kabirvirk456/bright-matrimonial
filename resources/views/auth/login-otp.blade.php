{{-- resources/views/auth/login-otp.blade.php --}}
@extends('layouts.guest')


@section('content')
<div class="max-w-md mx-auto mt-20 bg-white p-8 rounded shadow">
    <h2 class="text-xl font-bold mb-6">Login with OTP</h2>
    @if(session('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('login.otp.send') }}">
        @csrf
        <input type="text" name="mobile" inputmode="numeric" pattern="\d*" class="w-full border rounded px-3 py-2 mb-4" placeholder="Enter Mobile Number" required maxlength="10">
        <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700">Send OTP</button>
    </form>
    <a href="{{ route('login.choice') }}" class="text-pink-600 text-sm block mt-4 text-center">Back to Login</a>

</div>
@endsection
