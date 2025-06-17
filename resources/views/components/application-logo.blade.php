{{-- resources/views/components/loggedin-navbar.blade.php --}}
<nav class="bg-[#3B3738] shadow py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <img src="/images/logo.png" alt="Bright Matrimonial" class="h-8" />
            <span class="text-xl font-bold text-[#FFF056]">BRIGHT</span>
            <span class="text-lg font-semibold text-white">MATRIMONIAL</span>
        </div>
        <!-- Right side: Auth user info and menu -->
        <div class="flex items-center gap-6">
            <a href="{{ route('profile.index') }}" class="text-white hover:text-[#FFF056] font-semibold">My Profile</a>
            <a href="{{ route('matches.index') }}" class="text-white hover:text-[#FFF056]">Browse Matches</a>
            <!-- User Dropdown / Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-[#C63D0F] text-white px-4 py-2 rounded hover:bg-[#FFF056] hover:text-[#3B3738] font-semibold ml-4">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
