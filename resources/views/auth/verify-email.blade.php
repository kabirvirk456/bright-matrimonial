{{-- resources/views/auth/verify-email.blade.php --}}
@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-2 py-8">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl px-8 py-10">
        <h1 class="text-2xl font-bold text-center text-[#C63D0F] mb-6">Verify Your Email</h1>
        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __("Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.") }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-6 flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold py-2 rounded-lg transition text-lg shadow">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 rounded-lg text-sm transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
