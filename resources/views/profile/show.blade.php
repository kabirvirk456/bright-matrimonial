@extends('profile.layout')

@section('content')
    <div class="max-w-xl mx-auto py-10">
        <h2 class="font-semibold text-xl mb-6">My Profile</h2>

        <div class="bg-white p-6 rounded-2xl shadow flex flex-col gap-4">

            {{-- Show Name --}}
            <div>
                <strong>Name:</strong>
                {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
            </div>

            {{-- Religion --}}
            <div>
                <strong>Religion:</strong>
                {{ $profile->religion ? $profile->religion : ($profile->religion_id ? optional($profile->religionRelation)->name : '-') }}
            </div>

            {{-- Caste --}}
            <div>
                <strong>Caste:</strong>
                {{ $profile->caste ? $profile->caste : ($profile->caste_id ? optional($profile->casteRelation)->name : '-') }}
            </div>

            {{-- State --}}
            <div>
                <strong>State:</strong>
                {{ $profile->state ? $profile->state : ($profile->state_id ? optional($profile->stateRelation)->name : '-') }}
            </div>

            {{-- City --}}
            <div>
                <strong>City:</strong>
                {{ $profile->city ? $profile->city : ($profile->city_id ? optional($profile->cityRelation)->name : '-') }}
            </div>

            {{-- Mother Tongue --}}
            <div>
                <strong>Mother Tongue:</strong>
                {{ $profile->mother_tongue ? $profile->mother_tongue : ($profile->mother_tongue_id ? optional($profile->motherTongueRelation)->name : '-') }}
            </div>

            {{-- Marital Status --}}
            <div>
                <strong>Marital Status:</strong>
                {{ $profile->marital_status ?? '-' }}
            </div>

            {{-- About --}}
            <div>
                <strong>About:</strong>
                {{ $profile->about ?? '-' }}
            </div>

            {{-- Hobby --}}
            <div>
                <strong>Hobby:</strong>
                {{ optional($profile->hobby)->name ?? '-' }}
            </div>
            {{-- Add other fields here as you want --}}
        </div>
    </div>
@endsection
