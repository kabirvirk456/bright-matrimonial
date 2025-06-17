
@extends('layouts.guest')

@section('content')
    {{-- TOP BAR: Logo (left) & Login/Register (right) --}}
    <div class="absolute w-full top-0 left-0 flex justify-between items-center px-8 py-5 z-30">
        {{-- Logo --}}
        <div class="flex items-center gap-2">
            <img src="/images/logo.png" alt="Bright Matrimonial" class="h-10" />
            <span class="text-xl font-bold text-[#B83240]">BRIGHT</span>
            <span class="text-lg font-semibold text-white">MATRIMONIAL</span>
        </div>
        {{-- Buttons --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('login.choice') }}" class="bg-[#44303E] text-white px-6 py-2 rounded hover:bg-white hover:text-[#3B3738] font-semibold transition">Login</a>
            <a href="{{ route('register.choice') }}" class="bg-[#C63D0F] text-white px-6 py-2 rounded hover:bg-[#FFF056] hover:text-[#3B3738] font-bold transition">Register Free</a>
        </div>
    </div>

    {{-- HERO SECTION --}}
    <section class="relative min-h-[600px] flex items-end"
             style="background-image: url('/images/hero-bg.jpg'); background-size: cover; background-position: center;">
        <!-- Dark overlay -->
        <div class="absolute inset-0 bg-[#3B3738] opacity-20"></div>

        <!-- Headline & description (centered, not at bottom) -->
        <div class="absolute left-0 bottom-0 w-full z-10 flex flex-col items-center justify-center px-4">
            <h1 class="text-5xl md:text-4xl font-bold text-white text-center max-w-3xl leading-tight drop-shadow-lg">
                Find Your Perfect Match Today
            </h1>
            <p class="text-xl text-[#889B89] mt-4 drop-shadow max-w-2xl text-center">
                India’s trusted nature-based matchmaking platform.
            </p>
        </div>
        <!-- Search bar (floating at bottom center, over the hero image) -->
        <div class="absolute left-1/2 bottom-0 transform -translate-x-1/2 translate-y-1/2 w-full max-w-8xl px-4 z-20">
            <form method="GET" action="{{ route('matches.index') }}"
                  class="bg-white/90 p-4 rounded-xl shadow-md grid grid-cols-1 sm:grid-cols-6 gap-4 items-center backdrop-blur-sm">
                {{-- Gender --}}
                <div>
                    <select name="gender" id="gender" class="w-full rounded-md px-3 py-2 text-black">
                        <option value="">I'm looking for</option>
                        <option value="male">Man</option>
                        <option value="female">Woman</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                {{-- Age From and To --}}
                <div class="flex space-x-2 col-span-2">
                    <select name="age_min" id="age_min" class="flex-1 rounded-md px-3 py-2 text-black">
                        <option value="">Age from</option>
                        @for ($age = 18; $age <= 60; $age++)
                            <option value="{{ $age }}">{{ $age }}</option>
                        @endfor
                    </select>
                    <span class="inline-flex items-center px-2 text-[#3B3738] font-semibold">to</span>
                    <select name="age_max" id="age_max" class="flex-1 rounded-md px-3 py-2 text-black">
                        <option value="">Age to</option>
                        @for ($age = 18; $age <= 60; $age++)
                            <option value="{{ $age }}">{{ $age }}</option>
                        @endfor
                    </select>
                </div>
                {{-- Religion --}}
                <div>
                    <select name="religion" id="religion" class="w-full rounded-md px-3 py-2 text-black">
                        <option value="">Religion</option>
                        <option value="hindu">Hindu</option>
                        <option value="muslim">Muslim</option>
                        <option value="christian">Christian</option>
                        <option value="sikh">Sikh</option>
                    </select>
                </div>
                {{-- City --}}
                <div>
                    <select name="city" id="city" class="w-full rounded-md px-3 py-2 text-black">
                        <option value="">City</option>
                        <option value="mumbai">Mumbai</option>
                        <option value="delhi">Delhi</option>
                        <option value="bangalore">Bangalore</option>
                        <option value="hyderabad">Hyderabad</option>
                        <option value="ahmedabad">Ahmedabad</option>
                        <option value="pune">Pune</option>
                        <option value="chennai">Chennai</option>
                        <option value="kolkata">Kolkata</option>
                    </select>
                </div>
                {{-- Submit Button --}}
                <div>
                    <button type="submit" class="w-full bg-[#C63D0F] hover:bg-[#3B3738] text-white font-semibold rounded-md py-2 px-4 transition">
                        Let's Begin
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- 21 Questions Matchmaking Banner - Royal Luxury Style --}}
<section class="flex justify-center mt-20 mb-8 px-2">
    <div class="w-full max-w-5xl rounded-3xl bg-gradient-to-br from-[#44303E] via-[#B83240] to-[#AD324A] p-0.5 shadow-2xl relative border-2 border-[#B83240]/70">
        <div class="bg-[#2A1721]/80 rounded-3xl p-0.5 h-full w-full absolute inset-0 pointer-events-none" style="backdrop-filter: blur(6px); opacity: 0.15;"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-10 py-10">
            {{-- Left: Text --}}
            <div class="flex-1 min-w-[220px]">
                <div class="flex items-center mb-3">
                    <div class="flex items-center justify-center h-14 w-14 rounded-full bg-[#F4E6E7] shadow-lg mr-4 border-4 border-[#B83240]">
                        <span class="text-3xl font-extrabold text-[#B83240] font-serif drop-shadow-lg">21</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-[#F4E6E7] font-serif tracking-tight">
                        Nature Based Matchmaking Questions
                    </h2>
                </div>
                <p class="text-[#F4E6E7]/90 mb-5 font-medium text-base md:text-lg">
                    Crafted by India’s leading family counselors, these 21 questions are designed to identify your perfect nature-based compatibility.<br>
                    Simplify connections rooted in organic alignment.
                </p>
                <div class="text-sm text-[#F4E6E7]/60 mb-6">
                    Scientifically designed for compatibility &nbsp; | &nbsp; 100% confidential & user-friendly
                </div>
                <a href="{{ route('profile.questions') }}"
                    class="inline-block bg-[#B83240] hover:bg-[#44303E] text-white font-bold py-3 px-8 rounded-xl text-lg shadow-xl transition-all duration-150 transform hover:-translate-y-1 hover:scale-105 focus:ring-4 focus:ring-[#B83240]/40">
                    Try Nature Matchmaking Now &rarr;
                </a>
            </div>
            {{-- Right: Image --}}
            <div class="flex flex-col items-center gap-4 md:ml-10 mt-8 md:mt-0">
                <img src="/images/mmm.png" alt="Matchmaking" class="h-40 w-auto rounded-xl shadow-2xl border-4 border-[#F4E6E7]/80">
            </div>
        </div>
    </div>
</section>

{{-- OUR PROCESS — RED LINE ICONS, LARGE DIAMOND PLUS, CROSSHAIR LINES --}}
<section class="w-full bg-white py-24 px-2 md:px-10">
    <div class="max-w-7xl mx-auto relative min-h-[420px]">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-20 md:gap-0 md:grid-cols-2 md:grid-rows-2 place-items-center">
            <!-- Top Left -->
            <div class="flex flex-col items-center text-center">
                <!-- Register Icon -->
                <svg class="h-16 mb-4 text-[#B83240]" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5">
                    <rect x="13" y="9" width="38" height="46" rx="4" stroke="currentColor" stroke-width="2.5" />
                    <circle cx="32" cy="25" r="8" stroke="currentColor" stroke-width="2.5" />
                    <path d="M21 43c2.7-4.5 18.3-4.5 21 0" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    <circle cx="45" cy="19" r="4" fill="#fff" stroke="currentColor" stroke-width="2.5"/>
                    <polyline points="43,19 45,21 47,17" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <div class="text-2xl font-extrabold text-[#232323] mb-2 font-serif">Register</div>
                <div class="text-[#6A7895] text-base font-medium max-w-xs">
                    Follow a few easy steps to register and create your profile.
                </div>
            </div>
            <!-- Top Right -->
            <div class="flex flex-col items-center text-center">
                <!-- Explore Icon -->
                <svg class="h-16 mb-4 text-[#B83240]" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5">
                    <rect x="13" y="12" width="38" height="40" rx="4" stroke="currentColor" stroke-width="2.5" />
                    <rect x="20" y="18" width="24" height="6" rx="2" stroke="currentColor" stroke-width="2.5"/>
                    <rect x="20" y="28" width="18" height="4" rx="2" stroke="currentColor" stroke-width="2.5"/>
                    <circle cx="46" cy="36" r="5" stroke="currentColor" stroke-width="2.5"/>
                    <line x1="49.5" y1="39.5" x2="54" y2="44" stroke="currentColor" stroke-width="2.5"/>
                </svg>
                <div class="text-2xl font-extrabold text-[#232323] mb-2 font-serif">Explore</div>
                <div class="text-[#6A7895] text-base font-medium max-w-xs">
                    Browse through our huge collection of databases &amp; find the verified profiles.
                </div>
            </div>
            <!-- Bottom Left -->
            <div class="flex flex-col items-center text-center">
                <!-- Find Your Match Icon -->
                <svg class="h-16 mb-4 text-[#B83240]" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5">
                    <rect x="17" y="12" width="30" height="40" rx="4" stroke="currentColor" stroke-width="2.5"/>
                    <circle cx="32" cy="26" r="8" stroke="currentColor" stroke-width="2.5"/>
                    <path d="M22 44c3.5-6 16.5-6 20 0" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    <rect x="27" y="18" width="10" height="6" rx="2" stroke="currentColor" stroke-width="2"/>
                </svg>
                <div class="text-2xl font-extrabold text-[#232323] mb-2 font-serif">Find Your Match</div>
                <div class="text-[#6A7895] text-base font-medium max-w-xs">
                    With personalized matchmaking and a user-friendly experience, finding your perfect life partner.
                </div>
            </div>
            <!-- Bottom Right -->
            <div class="flex flex-col items-center text-center">
                <!-- Connect Icon -->
                <svg class="h-16 mb-4 text-[#B83240]" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5">
                    <ellipse cx="24" cy="28" rx="8" ry="8" stroke="currentColor" stroke-width="2.5"/>
                    <ellipse cx="40" cy="28" rx="8" ry="8" stroke="currentColor" stroke-width="2.5"/>
                    <path d="M16 44c3.5-6 28.5-6 32 0" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M32 18c0-4 6-6 10-2" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M44 19l2.5-3 2.5 3" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <div class="text-2xl font-extrabold text-[#232323] mb-2 font-serif">Connect</div>
                <div class="text-[#6A7895] text-base font-medium max-w-xs">
                    A personalized and user-friendly experience, finding your perfect partner has never been easier.
                </div>
            </div>
        </div>
        <!-- Center Big Diamond with Crosshair Lines -->
        <div class="hidden md:block absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
                <!-- Black lines -->
                <line x1="60" y1="0" x2="60" y2="44" stroke="#232323" stroke-width="2"/>
                <line x1="60" y1="76" x2="60" y2="120" stroke="#232323" stroke-width="2"/>
                <line x1="0" y1="60" x2="44" y2="60" stroke="#232323" stroke-width="2"/>
                <line x1="76" y1="60" x2="120" y2="60" stroke="#232323" stroke-width="2"/>
                <!-- Red diamond/star (bigger) -->
                <polygon points="60,50 70,60 60,70 50,60" fill="#B83240"/>
            </svg>
        </div>
    </div>
</section>


   {{-- APP FEATURE SECTION - Mobile App Promo (Redesigned) --}}
<section class="relative w-full flex flex-col md:flex-row items-center rounded-3xl shadow-2xl mx-2 md:mx-10 my-12 overflow-hidden bg-gradient-to-br from-[#44303E] via-[#B83240] to-[#AD324A]">
    <!-- Subtle white overlay for readability -->
    <div class="absolute inset-0 bg-white opacity-15 pointer-events-none z-0"></div>
    <!-- Content -->
    <div class="relative z-10 flex-1 flex flex-col md:flex-row items-center w-full h-full">
        <!-- Left: Text and icons -->
        <div class="flex-1 flex flex-col justify-center items-start px-8 py-10 md:pl-16 md:py-10">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-2 drop-shadow-lg">
                Mobile <span class="text-[#FFF056]">App</span>
            </h2>
            <p class="text-lg text-[#F4E6E7] mb-6 max-w-xl font-medium drop-shadow">
                Find your perfect match on the go! Download our app for advanced features, privacy-first experience, and trusted connections—powered by Bright Matrimonial.
            </p>
            <!-- Icon Row -->
            <div class="flex space-x-6 mb-6">
                <div class="bg-[#FFF056] rounded-full p-3 shadow-lg"><img src="/images/verify.png" class="h-7 w-7" alt="Feature 1"></div>
                <div class="bg-[#FFF056] rounded-full p-3 shadow-lg"><img src="/images/conversation-2.png" class="h-7 w-7" alt="Feature 2"></div>
                <div class="bg-[#FFF056] rounded-full p-3 shadow-lg"><img src="/images/contact.png" class="h-7 w-7" alt="Feature 3"></div>
                <div class="bg-[#FFF056] rounded-full p-3 shadow-lg"><img src="/images/chat.png" class="h-7 w-7" alt="Feature 4"></div>
            </div>
            <!-- Feature List -->
            <ul class="mb-6 space-y-2 text-base font-semibold text-white">
                <li class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-[#FFF056]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Search by location, community, profession & more
                </li>
                <li class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-[#FFF056]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Verified profiles for peace of mind
                </li>
                <li class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-[#FFF056]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Private chat and advanced privacy settings
                </li>
            </ul>
            <!-- Store Buttons -->
            <div class="flex items-center gap-4 mt-2">
                <a href="#" class="transition hover:scale-105"><img src="/images/app store.png" alt="App Store" class="h-14 drop-shadow-xl"></a>
                <a href="#" class="transition hover:scale-105"><img src="/images/playstore.png" alt="Play Store" class="h-14 drop-shadow-xl"></a>
            </div>
        </div>
        <!-- Right: App Mockup -->
        <div class="flex-1 flex items-center justify-center relative z-10 py-6">
            <img src="/images/s3.jpg" alt="Mobile App" class="h-[380px] md:h-[400px] w-auto rounded-2xl shadow-2xl border-4 border-white object-cover z-20 mr-3">
            <img src="/images/s4.jpg" alt="Mobile App" class="h-[380px] md:h-[400px] w-auto rounded-2xl shadow-2xl border-4 border-white object-cover z-20">
        </div>
    </div>
</section>

   

  {{-- FIND MATCH BY - Filter & Profiles Section --}}
<livewire:find-match-section />

{{-- ======= FOOTER ONLY FOR HOMEPAGE ======= --}}
    <footer class="bg-[#44303E] text-white py-12 mt-0">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand & Tagline -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <img src="/images/logo.png" alt="Bright Matrimonial Logo" class="h-10 w-auto">
                    <div>
                        <span class="text-xl font-bold text-[#FFF056]">BRIGHT</span>
                        <span class="text-lg font-semibold text-white">MATRIMONIAL</span>
                    </div>
                </div>
                <p class="text-gray-300 text-sm">
                    India’s trusted platform for genuine, nature-based matchmaking. <br>
                    <span class="italic text-[#FFF056]">"Yaha Rishte Bante Nahi, Tikte Hai"</span>
                </p>
            </div>
            <!-- Quick Links -->
            <div>
                <h4 class="font-bold text-[#FFF056] mb-3">Quick Links</h4>
                <ul class="space-y-2 text-gray-200 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('register.choice') }}" class="hover:underline">Register Free</a></li>

                    <li><a href="{{ route('login.choice') }}" class="hover:underline">Login</a></li>

                    <li><a href="{{ route('profile.questions') }}" class="hover:underline">Nature Matchmaking</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:underline">Contact Us</a></li>
                </ul>
            </div>
            <!-- Legal/Support -->
            <div>
                <h4 class="font-bold text-[#FFF056] mb-3">Support & Legal</h4>
                <ul class="space-y-2 text-gray-200 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:underline">About Us</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:underline">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:underline">Terms & Conditions</a></li>
                    <li><a href="{{ route('help') }}" class="hover:underline">Help & FAQ</a></li>
                    <li><a href="{{ route('refund') }}" class="hover:underline">Refund & Cancellation</a></li>
                </ul>
            </div>
            <!-- Contact / App Download -->
            <div>
                <h4 class="font-bold text-[#FFF056] mb-3">Contact</h4>
                <p class="text-gray-300 text-sm mb-2">
                    <span class="font-semibold">Email:</span>
                    <a href="mailto:info@brightmatrimonial.com" class="hover:underline">info@brightmatrimonial.com</a>
                </p>
                <p class="text-gray-300 text-sm mb-2">
                    <span class="font-semibold">Helpline:</span> +91-90000-12345
                </p>
                <div class="mt-4 flex gap-2">
                    <a href="#" class="inline-block">
                        <img src="/images/app store.png" alt="App Store" class="h-10">
                    </a>
                    <a href="#" class="inline-block">
                        <img src="/images/playstore.png" alt="Play Store" class="h-10">
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-400 text-xs mt-10 pt-6 border-t border-[#889B89]/40">
            &copy; {{ date('Y') }} <span class="text-[#FFF056] font-semibold">Bright Matrimonial</span>. All rights reserved.
        </div>
    </footer>
@endsection