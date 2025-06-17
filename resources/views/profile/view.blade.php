@extends('profile.layout')

@section('section_content')
    <div class="bg-gray-50 py-10 min-h-screen">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-2xl p-8">

            {{-- Top section: Photo and Basic Info --}}
            <div class="flex flex-col md:flex-row items-center gap-6 mb-8">
                <img src="{{ $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($profile->user->first_name ?? 'User') }}"
                    alt="Profile photo"
                    class="w-32 h-32 object-cover rounded-xl border-4 border-pink-400 shadow">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-semibold text-pink-600 uppercase">Premium</span>
                        <span class="ml-2 text-xs text-gray-400">Member ID: {{ $profile->user->id ?? 'N/A' }}</span>
                    </div>
                    <div class="font-bold text-2xl text-gray-800">
                        {{ $profile->user->first_name ?? '' }} {{ $profile->user->last_name ?? '' }}
                        @if($profile->user->photo_verification_status === 'verified')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-green-700 bg-green-100 font-semibold text-xs mt-1">
                                <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Profile Photo Verified
                            </span>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-3 mt-2 text-sm text-gray-600">
                        @if($profile->dob)
                            <span><b>Age:</b> {{ \Carbon\Carbon::parse($profile->dob)->age }} yrs</span>
                        @endif
                        @if($profile->height)
                            <span><b>Height:</b> {{ $profile->height }} cm</span>
                        @endif
                        @if($profile->religion)
                            <span><b>Religion:</b> {{ ucfirst($profile->religion) }}</span>
                        @endif
                        @if($profile->marital_status)
                            <span><b>Status:</b> {{ ucfirst($profile->marital_status) }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Action buttons --}}
            <div class="flex gap-3 mb-8">
                <a href="#" class="bg-gray-100 text-pink-600 px-4 py-2 rounded font-semibold text-sm hover:bg-pink-50">Express Interest</a>
                <a href="#" class="bg-gray-100 text-gray-700 px-4 py-2 rounded font-semibold text-sm hover:bg-gray-200">Shortlist</a>
                <a href="#" class="bg-gray-100 text-red-600 px-4 py-2 rounded font-semibold text-sm hover:bg-red-50">Report</a>
            </div>

            {{-- Info section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700 mb-8">
                <div>
                    <div class="font-semibold mb-2 text-pink-600">Personal Details</div>
                    <div class="mb-1"><b>Caste:</b> {{ $profile->caste ?? '--' }}</div>
                    <div class="mb-1"><b>First Language:</b> {{ $profile->mother_tongue ?? '--' }}</div>
                    <div class="mb-1"><b>City:</b> {{ $profile->city ?? '--' }}</div>
                    <div class="mb-1"><b>State:</b> {{ $profile->state ?? '--' }}</div>
                    <div class="mb-1"><b>Country:</b> {{ $profile->country ?? '--' }}</div>
                    <div class="mb-1"><b>Diet:</b> {{ $profile->diet ?? '--' }}</div>
                </div>
                <div>
                    <div class="font-semibold mb-2 text-pink-600">Professional</div>
                    <div class="mb-1"><b>Qualification:</b> {{ $profile->highest_qualification ?? '--' }}</div>
                    <div class="mb-1"><b>Profession:</b> {{ $profile->company_position ?? '--' }}</div>
                    <div class="mb-1"><b>Income:</b> {{ $profile->income ?? '--' }}</div>
                </div>
            </div>

            {{-- About section --}}
            <div class="bg-gray-50 rounded-xl p-5 mb-8">
                <div class="font-semibold mb-1 text-pink-600">About</div>
                <div class="text-gray-700 text-sm">
                    {{ $profile->about ?? '--' }}
                </div>
            </div>

            <a href="{{ route('matches.index') }}" class="text-pink-600 hover:underline text-sm">← Back to Browse</a>
        </div>
    </div>
@endsection
