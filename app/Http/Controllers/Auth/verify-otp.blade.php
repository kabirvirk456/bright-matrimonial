<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
            <h1 class="text-2xl mb-6 font-bold text-center">Enter OTP</h1>
            @if(session('success'))
                <div class="mb-4 text-green-600 text-sm">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('register.otp.check') }}">
                @csrf
                <input type="text" name="otp" placeholder="Enter OTP" required class="w-full mb-4 px-4 py-2 rounded border" />
                <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded font-semibold">
                    Verify OTP
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
