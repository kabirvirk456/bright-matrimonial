{{-- Alpine.js is required for the popup! --}}
<script src="//unpkg.com/alpinejs" defer></script>

@extends('profile.layout')

@section('section_content')
    {{-- Success Popup after sending request --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition
            class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50">
            <div class="bg-green-500 text-white font-semibold px-6 py-3 rounded-xl shadow-lg flex items-center gap-4">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 text-white text-xl">&times;</button>
            </div>
        </div>
        {{-- Fallback for if Alpine.js isn't loaded --}}
        <noscript>
            <div class="fixed top-8 left-1/2 transform -translate-x-1/2 z-50">
                <div class="bg-green-500 text-white font-semibold px-6 py-3 rounded-xl shadow-lg flex items-center gap-4">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </noscript>
    @endif

    <div class="bg-gray-50 py-10 min-h-screen">
        {{-- Advanced Search --}}
        <form method="GET" action="{{ route('matches.index') }}" class="max-w-7xl mx-auto bg-white shadow rounded-xl px-6 py-4 mb-10">
            <div class="grid md:grid-cols-6 gap-3">
                <input type="text" name="member_id" placeholder="Member ID"
                    class="col-span-1 border rounded px-3 py-2 text-sm" value="{{ request('member_id') }}">

                <select name="marital_status" class="col-span-1 border rounded px-3 py-2 text-sm">
                    <option value="">Marital Status</option>
                    <option value="single" {{ request('marital_status')=='single'?'selected':'' }}>Single</option>
                    <option value="divorced" {{ request('marital_status')=='divorced'?'selected':'' }}>Divorced</option>
                    <option value="widowed" {{ request('marital_status')=='widowed'?'selected':'' }}>Widowed</option>
                </select>

                <select name="religion" class="col-span-1 border rounded px-3 py-2 text-sm">
                    <option value="">Religion</option>
                    <option value="hindu" {{ request('religion')=='hindu'?'selected':'' }}>Hindu</option>
                    <option value="muslim" {{ request('religion')=='muslim'?'selected':'' }}>Muslim</option>
                    <option value="christian" {{ request('religion')=='christian'?'selected':'' }}>Christian</option>
                    <option value="sikh" {{ request('religion')=='sikh'?'selected':'' }}>Sikh</option>
                </select>

                <select name="caste" class="col-span-1 border rounded px-3 py-2 text-sm">
                    <option value="">Caste</option>
                    @if(isset($castes))
                        @foreach($castes as $caste)
                            <option value="{{ $caste }}" {{ request('caste') == $caste ? 'selected' : '' }}>{{ $caste }}</option>
                        @endforeach
                    @endif
                </select>

                <select name="mother_tongue" class="col-span-1 border rounded px-3 py-2 text-sm">
                    <option value="">Mother Tongue</option>
                    @if(isset($mother_tongues))
                        @foreach($mother_tongues as $mt)
                            <option value="{{ $mt }}" {{ request('mother_tongue') == $mt ? 'selected' : '' }}>{{ $mt }}</option>
                        @endforeach
                    @endif
                </select>

                <select name="state" class="col-span-1 border rounded px-3 py-2 text-sm">
                    <option value="">State</option>
                    @if(isset($states))
                        @foreach($states as $state)
                            <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>{{ $state }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="flex flex-col md:flex-row items-center gap-3 mt-4">
                <input type="text" name="city" placeholder="City" class="border rounded px-3 py-2 text-sm w-full md:w-auto" value="{{ request('city') }}">
                <input type="number" name="age_from" placeholder="Age from" class="border rounded px-3 py-2 text-sm w-1/2 md:w-auto" value="{{ request('age_from') }}">
                <input type="number" name="age_to" placeholder="Age to" class="border rounded px-3 py-2 text-sm w-1/2 md:w-auto" value="{{ request('age_to') }}">
                <button class="ml-auto bg-pink-600 text-white px-6 py-2 rounded font-semibold hover:bg-pink-700">Search Now</button>
            </div>
        </form>

        {{-- Member Grid --}}
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($matches as $profile)
                    <div class="bg-white rounded-2xl shadow p-5 flex flex-col gap-3">
                        <div class="flex items-center gap-4">
                            <img src="{{ $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($profile->user->first_name ?? 'User') }}"
                                alt="Profile photo"
                                class="w-16 h-16 object-cover rounded-xl border-2 border-pink-400">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold text-pink-600 uppercase">Premium</span>
                                    <span class="ml-2 text-xs text-gray-400">Member ID: {{ $profile->user->id ?? 'N/A' }}</span>
                                </div>
                                <div class="font-bold text-base">{{ $profile->user->first_name ?? '' }} {{ $profile->user->last_name ?? '' }}</div>
                                <div class="flex gap-1 text-xs text-gray-500">
                                    @if($profile->user->photo_verification_status === 'verified')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-green-700 bg-green-100 font-semibold text-xs ml-1">
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Verified
                                        </span>
                                    @endif
                                    <span>{{ $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age.' Years' : '' }}</span>
                                    <span>{{ $profile->height ? '• '.$profile->height.' cm' : '' }}</span>
                                    <span>{{ $profile->religion ? '• '.ucfirst($profile->religion) : '' }}</span>
                                </div>
                            </div>
                            <div class="ml-auto flex gap-2">
                                <form action="{{ route('matches.sendRequest', $profile->user->id) }}" method="POST">
                                    @csrf
                                    @if(isset($sentRequests) && in_array($profile->user->id, $sentRequests))
                                        <button type="button" class="bg-gray-400 cursor-not-allowed text-white px-4 py-1 mt-2 rounded" disabled>
                                            Request Sent
                                        </button>
                                    @else
                                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-1 mt-2 rounded">
                                            Send Request
                                        </button>
                                    @endif
                                </form>
                                <button title="Report" class="rounded-full p-2 hover:bg-red-50 text-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18.364 5.636l-1.414-1.414a2 2 0 0 0-2.828 0l-8.485 8.485a2 2 0 0 0 0 2.828l1.414 1.414a2 2 0 0 0 2.828 0l8.485-8.485a2 2 0 0 0 0-2.828z"/></svg>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                            <div><span class="font-semibold">Caste:</span> {{ $profile->caste ?? '--' }}</div>
                            <div><span class="font-semibold">First Language:</span> {{ $profile->mother_tongue ?? '--' }}</div>
                            <div><span class="font-semibold">Marital Status:</span> {{ ucfirst($profile->marital_status ?? '--') }}</div>
                            <div><span class="font-semibold">City:</span> {{ $profile->city ?? '--' }}</div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <a href="{{ route('profile.view', $profile->user->id) }}" class="bg-gray-100 text-pink-600 px-3 py-1 rounded hover:bg-pink-50 text-xs font-semibold">View Profile</a>
                            <a href="#" class="bg-gray-100 text-gray-600 px-3 py-1 rounded hover:bg-gray-200 text-xs font-semibold">Mark Shortlist</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-500">No profiles found.</div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $matches->links() }}
            </div>
        </div>
    </div>
@endsection
