{{-- resources/views/profile/sidebar.blade.php --}}
<aside class="w-60 bg-white rounded-3xl shadow-2xl border border-pink-100 flex flex-col items-center py-8 mx-4 mt-6 min-h-[90vh]">

    <nav class="flex-1 flex flex-col gap-3 w-full px-2">
        <a href="{{ route('matches.index') }}"
           class="py-3 px-5 rounded-2xl font-semibold text-pink-700 bg-pink-50/40 hover:bg-pink-200 transition-all shadow-sm hover:shadow-lg w-full block text-base text-left">
            Find Matches
        </a>
        <a href="{{ route('interests.received') }}"
           class="py-3 px-5 rounded-2xl font-semibold text-pink-700 bg-pink-50/40 hover:bg-pink-200 transition-all shadow-sm hover:shadow-lg w-full block text-base text-left">
            Interests Received
        </a>
        <a href="{{ route('interests.sent') }}"
           class="py-3 px-5 rounded-2xl font-semibold text-pink-700 bg-pink-50/40 hover:bg-pink-200 transition-all shadow-sm hover:shadow-lg w-full block text-base text-left">
            Interests Sent
        </a>
        <a href="{{ route('profile.personal-info') }}"
           class="py-3 px-5 rounded-2xl font-semibold text-pink-700 bg-pink-50/40 hover:bg-pink-200 transition-all shadow-sm hover:shadow-lg w-full block text-base text-left">
            Profile
        </a>
        <a href="#" class="py-3 px-5 rounded-2xl font-semibold text-pink-700 bg-pink-50/40 hover:bg-pink-200 transition-all shadow-sm hover:shadow-lg w-full block text-base text-left">
            Chat
        </a>
    </nav>

    <div class="mt-auto w-full px-2">
        <form action="{{ route('logout') }}" method="POST">@csrf
            <button class="py-3 px-5 rounded-2xl font-semibold text-pink-700 bg-pink-50/40 hover:bg-pink-200 transition-all shadow-sm hover:shadow-lg w-full block text-base text-left">
                Logout
            </button>
        </form>
    </div>
</aside>
