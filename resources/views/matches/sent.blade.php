<script src="//unpkg.com/alpinejs" defer></script>

@extends('profile.layout')

@section('section_content')
    <div class="bg-gray-50 py-10 min-h-screen">
        <h2 class="text-2xl font-bold mb-8 px-6">Interests Sent</h2>
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($interests as $interest)
                    @php
                        $profile = $interest->toUser->profile ?? null;
                        $user = $interest->toUser ?? null;
                    @endphp
                    @if($profile && $user)
                    <div class="bg-white rounded-2xl shadow p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-4">
                            <img src="{{ $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->first_name ?? 'User') }}"
                                 alt="Profile photo"
                                 class="w-16 h-16 object-cover rounded-xl border-2 border-pink-400">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold text-pink-600 uppercase">Premium</span>
                                    <span class="ml-2 text-xs text-gray-400">Member ID: {{ $user->id ?? 'N/A' }}</span>
                                </div>
                                <div class="font-bold text-base">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</div>
                                <div class="flex gap-1 text-xs text-gray-500">
                                    <span>{{ $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age.' Years' : '' }}</span>
                                    <span>{{ $profile->height ? '• '.$profile->height.' cm' : '' }}</span>
                                    <span>{{ $profile->religion ? '• '.ucfirst($profile->religion) : '' }}</span>
                                </div>
                                <div class="mt-1">
                                    <span class="bg-yellow-200 text-yellow-900 px-2 py-1 text-xs rounded">Status: {{ ucfirst($interest->status) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                            <div><span class="font-semibold">Caste:</span> {{ $profile->caste ?? '--' }}</div>
                            <div><span class="font-semibold">First Language:</span> {{ $profile->mother_tongue ?? '--' }}</div>
                            <div><span class="font-semibold">Marital Status:</span> {{ ucfirst($profile->marital_status ?? '--') }}</div>
                            <div><span class="font-semibold">City:</span> {{ $profile->city ?? '--' }}</div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <a href="{{ route('profile.view', $user->id) }}" class="bg-gray-100 text-pink-600 px-3 py-1 rounded hover:bg-pink-50 text-xs font-semibold">View Profile</a>
                        </div>
                    </div>
                    @endif
                @empty
                    <div class="col-span-2 text-center text-gray-500">No interests sent yet.</div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $interests->links() }}
            </div>
        </div>
    </div>
@endsection
