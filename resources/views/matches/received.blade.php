@extends('profile.layout')

@section('section_content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow p-8">
    <h2 class="text-xl font-bold mb-6">Interests Received</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($interests as $interest)
            @php
                $profile = $interest->fromUser->profile ?? null;
                $fromUser = $interest->fromUser ?? null;
            @endphp
            <div class="border rounded-xl p-5 flex gap-4 bg-gray-50 items-center">
                <img src="{{ $profile && $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($fromUser->first_name ?? 'User') }}"
                    alt="Profile photo"
                    class="w-16 h-16 object-cover rounded-xl border-2 border-pink-400">
                <div>
                    <div class="font-bold">{{ $fromUser->first_name ?? '' }} {{ $fromUser->last_name ?? '' }}</div>
                    <div class="text-xs text-gray-400">Member ID: {{ $fromUser->id ?? '' }}</div>
                    <div class="flex gap-2 text-sm text-gray-600">
                        <span>{{ $profile->dob ?? '' }}</span>
                        <span>{{ $profile->religion ? '• '.ucfirst($profile->religion) : '' }}</span>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Status: {{ ucfirst($interest->status) }}</span>
                        <a href="{{ route('profile.view', $fromUser->id) }}" class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full text-xs font-semibold hover:bg-pink-200">View Profile</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-500">No interests received.</div>
        @endforelse
    </div>
    <div class="mt-8">{{ $interests->links() }}</div>
</div>
@endsection
