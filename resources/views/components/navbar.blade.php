<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-[#3B3738] shadow py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <img src="/images/logo.png" alt="Bright Matrimonial" class="h-8" />
            <span class="text-xl font-bold text-[#FFF056]">BRIGHT</span>
            <span class="text-lg font-semibold text-white">MATRIMONIAL</span>
        </div>
        <!-- Guest/Links -->
        <div class="flex items-center gap-6">
            <a href="{{ route('login') }}" class="bg-[#889B89] text-white px-5 py-2 rounded hover:bg-white hover:text-[#3B3738] font-semibold transition">Login</a>
            <a href="{{ route('register') }}" class="bg-[#C63D0F] text-white px-5 py-2 rounded hover:bg-[#FFF056] hover:text-[#3B3738] font-bold transition">Register Free</a>
        </div>
    </div>
</nav>
