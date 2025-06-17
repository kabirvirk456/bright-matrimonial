<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">
      {{ $profile->user->name }}’s Profile
    </h2>
  </x-slot>

  <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      {{-- Photo --}}
      @if($profile->photo)
        <img src="{{ asset('storage/'.$profile->photo) }}"
             alt="Photo of {{ $profile->user->name }}"
             class="w-full h-64 object-cover rounded">
      @else
        <div class="w-full h-64 bg-gray-100 flex items-center justify-center rounded">
          <span class="text-gray-400">No photo</span>
        </div>
      @endif

      {{-- Details --}}
      <div class="space-y-4">
        <p><strong>Gender:</strong> {{ ucfirst($profile->gender) }}</p>
        <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($profile->dob)->age }} yrs</p>
        <p><strong>City:</strong> {{ $profile->city }}</p>
        <p><strong>Member since:</strong> {{ $profile->created_at->format('F j, Y') }}</p>
      </div>
    </div>

    {{-- Bio --}}
    @if($profile->bio)
      <div>
        <h3 class="font-semibold">About</h3>
        <p class="mt-2 text-gray-700">{{ $profile->bio }}</p>
      </div>
    @endif

    {{-- Actions --}}
    <div class="flex space-x-4">
      <a href="{{ route('matches.index') }}"
         class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
        ← Back to Matches
      </a>

      {{-- Placeholder for future “express interest” --}}
      <button class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600">
        Express Interest ❤️
      </button>
    </div>
  </div>
</x-app-layout>
