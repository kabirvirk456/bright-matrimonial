<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
            <h1 class="text-2xl mb-6 font-bold text-center">Login with Mobile OTP</h1>
            <form method="POST" action="{{ route('login.otp.send') }}">
                @csrf
                <input type="text" name="mobile" placeholder="Enter mobile number" required class="w-full mb-4 px-4 py-2 rounded border" />
                <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded font-semibold">
                    Send OTP
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
