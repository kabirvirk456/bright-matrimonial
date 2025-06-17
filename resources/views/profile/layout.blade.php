@extends('layouts.app')

@section('content')
<div class="flex bg-[#F7F8FA] min-h-screen">
    {{-- Sidebar --}}
    @include('profile.sidebar')
    <main class="flex-1 p-10">
        <!-- Choices.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<!-- Choices.js JS -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

        {{-- Profile Top Card (only ONE place) --}}
        @include('profile.partials.profile-topbar', ['user' => $user ?? auth()->user(), 'profile' => $profile ?? (auth()->user()->profile ?? null)])

        {{-- Profile Section Tabs as Buttons --}}
        <div class="flex gap-3 mb-6 mt-10">
            <a href="{{ route('profile.personal-info') }}"
                class="px-4 py-2 rounded-full font-semibold transition-all
                {{ request()->routeIs('profile.personal-info') ? 'bg-pink-600 text-white shadow' : 'bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-700' }}">
                Personal Info
            </a>
            <a href="{{ route('profile.education-career') }}"
                class="px-4 py-2 rounded-full font-semibold transition-all
                {{ request()->routeIs('profile.education-career') ? 'bg-pink-600 text-white shadow' : 'bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-700' }}">
                Education & Career
            </a>
            <a href="{{ route('profile.family-details') }}"
                class="px-4 py-2 rounded-full font-semibold transition-all
                {{ request()->routeIs('profile.family-details') ? 'bg-pink-600 text-white shadow' : 'bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-700' }}">
                Family Details
            </a>
            <a href="{{ route('profile.lifestyle') }}"
                class="px-4 py-2 rounded-full font-semibold transition-all
                {{ request()->routeIs('profile.lifestyle') ? 'bg-pink-600 text-white shadow' : 'bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-700' }}">
                Lifestyle
            </a>
            <a href="{{ route('profile.likes') }}"
                class="px-4 py-2 rounded-full font-semibold transition-all
                {{ request()->routeIs('profile.likes') ? 'bg-pink-600 text-white shadow' : 'bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-700' }}">
                Likes
            </a>
            <a href="{{ route('profile.horoscope') }}"
                class="px-4 py-2 rounded-full font-semibold transition-all
                {{ request()->routeIs('profile.horoscope') ? 'bg-pink-600 text-white shadow' : 'bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-700' }}">
                Horoscope
            </a>
            <a href="{{ route('profile.questions') }}"
                class="px-4 py-2 rounded-full font-semibold transition-all
                {{ request()->routeIs('profile.questions') ? 'bg-pink-600 text-white shadow' : 'bg-gray-200 text-gray-700 hover:bg-pink-100 hover:text-pink-700' }}">
                21 Questions
            </a>
        </div>

        {{-- Yield section content for sub-pages --}}
        @yield('section_content')
    </main>
</div>
@endsection
