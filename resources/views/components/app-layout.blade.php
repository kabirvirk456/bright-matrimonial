{{-- resources/views/components/app-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- LOGGED-IN NAVBAR -->
        @auth
        <nav class="bg-[#3B3738] px-4 py-4 shadow flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="/images/logo.png" alt="Bright Matrimonial" class="h-8" />
                <span class="text-xl font-bold text-[#FFF056]">BRIGHT</span>
                <span class="text-lg font-semibold text-white">MATRIMONIAL</span>
            </div>
            <div class="flex items-center gap-8">
                <a href="{{ route('matches.index') }}" class="text-white hover:text-[#FFF056] font-medium">Browse Profiles</a>
                <a href="{{ route('profile.personal-info') }}" class="text-white hover:text-[#FFF056] font-medium">View Profile</a>
                <a href="{{ route('profile.questions') }}" class="text-white hover:text-[#FFF056] font-medium">Nature Matchmaking</a>
                <a href="{{ route('help') }}" class="text-white hover:text-[#FFF056] font-medium">Help</a>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-white font-semibold hidden md:inline">
                    Hi, {{ Auth::user()->first_name ?? Auth::user()->name ?? 'User' }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-[#C63D0F] bg-white px-4 py-2 rounded hover:bg-[#FFF056] hover:text-[#3B3738] font-semibold transition">Logout</button>
                </form>
            </div>
        </nav>
        @endauth

        {{ $slot }}
    </div>
</body>
</html>
