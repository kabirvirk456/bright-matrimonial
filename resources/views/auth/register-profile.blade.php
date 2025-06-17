@php $showNavbar = false; @endphp
@extends('layouts.guest')
@section('content')
<div class="min-h-screen flex items-center justify-center px-2 md:px-8 bg-gradient-to-br from-[#FFF3E6] via-[#F4E6E7] to-[#E7D8D6] relative">

    {{-- Background SVG Waves --}}
    <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" viewBox="0 0 1600 900" fill="none">
        <path d="M 0 500 Q 400 700 800 500 Q 1200 300 1600 500 L 1600 900 L 0 900 Z"
              fill="#FFF056" fill-opacity="0.11"/>
        <path d="M 0 200 Q 700 300 1600 100" stroke="#B83240" stroke-width="2" fill="none" opacity="0.07"/>
        <path d="M 0 700 Q 600 800 1600 850" stroke="#C63D0F" stroke-width="2" fill="none" opacity="0.09"/>
    </svg>

    <div class="relative z-10 w-full max-w-5xl bg-white rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
        {{-- Left Panel --}}
        <div class="hidden md:flex flex-col justify-between items-center w-1/2 py-12 px-6 bg-gradient-to-b from-[#C63D0F] to-[#FFF056] text-white">
            <div class="flex flex-col items-center gap-3">
                <img src="/images/logo.png" alt="Bright Matrimonial" class="h-16">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-extrabold text-[#FFF056] tracking-tight">BRIGHT</span>
                    <span class="text-xl font-bold text-white">MATRIMONIAL</span>
                </div>
                <div class="text-xs text-[#3B3738] font-medium mt-1">
                    Yaha Rishte Bante Nahi, Tikte Hai
                </div>
                <h2 class="text-3xl font-bold mt-8 drop-shadow-lg">Welcome</h2>
                <p class="text-lg text-center mt-2 text-white/90">Complete your profile to get better match suggestions from Bright Matrimonial!</p>
            </div>
            <a href="{{ route('login') }}" class="w-full mt-8">
                <button class="bg-white text-[#C63D0F] font-semibold rounded-full px-8 py-2 shadow transition hover:bg-[#FFF056] hover:text-[#3B3738] w-full">
                    Login
                </button>
            </a>
        </div>

        {{-- Right Panel: Profile Form --}}
        <div class="flex-1 py-10 px-6 md:px-10">
            <h2 class="text-2xl font-bold mb-2 text-[#C63D0F] text-center">Complete Your Profile</h2>
            <p class="text-center text-gray-500 text-sm mb-6">Step 2 of 2: Tell us about yourself for more accurate matches.</p>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.profile.save') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                {{-- About --}}
                <div class="md:col-span-2">
                    <label for="about" class="block font-semibold mb-1 text-[#3B3738]">About You</label>
                    <textarea name="about" id="about" rows="3" class="w-full border border-[#C63D0F] rounded-lg p-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition resize-none">{{ old('about') }}</textarea>
                    @error('about') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Religion --}}
                <div>
                    <label class="block text-[#3B3738] font-semibold">Religion *</label>
                    <select name="religion_id" id="religion-dropdown"
    class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056]"
    required>
    <option value="">Select Religion</option>
    @foreach($religions as $id => $name)
        <option value="{{ $id }}" {{ old('religion_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
    @endforeach
</select>

                    @error('religion_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Caste --}}
                <div>
                    <label class="block text-[#3B3738] font-semibold">Caste *</label>
                    <select name="caste_id" id="caste-dropdown"
        class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056]"
        required>
        <option value="">Select Caste</option>
        @foreach($castes as $id => $name)
            <option value="{{ $id }}" {{ old('caste_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
                    @error('caste_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- State --}}
                <div>
                    <label class="block text-[#3B3738] font-semibold">State *</label>
                    <select name="state_id" id="state-dropdown" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056]" required>
                        <option value="">Select State</option>
                        @foreach($states as $id => $name)
                            <option value="{{ $id }}" {{ old('state_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('state_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- City --}}
                <div>
                    <label class="block text-[#3B3738] font-semibold">City *</label>
                    <select name="city_id" id="city-dropdown" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056]" required>
                        <option value="">Select City</option>
                        @foreach($cities as $id => $name)
                            <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('city_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Mother Tongue --}}
                <div>
                    <label class="block text-[#3B3738] font-semibold">Mother Tongue *</label>
                    <select name="mother_tongue_id" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056]" required>
                        <option value="">Select Mother Tongue</option>
                        @foreach($motherTongues as $id => $name)
                            <option value="{{ $id }}" {{ old('mother_tongue_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('mother_tongue_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Hobby (Dynamic) --}}
                <div>
                    <label class="block text-[#3B3738] font-semibold">Hobby</label>
                    <select name="hobby_id" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056]">
                        <option value="">Select Hobby</option>
                        @if(isset($hobbies) && count($hobbies))
                            @foreach($hobbies as $id => $name)
                                <option value="{{ $id }}" {{ old('hobby_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('hobby_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Marital Status --}}
                <div>
                    <label for="marital_status" class="block text-[#3B3738] font-semibold">Marital Status</label>
                    <select name="marital_status" id="marital_status" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056]">
                        <option value="">Select Marital Status</option>
                        @foreach(['Single', 'Married', 'Divorced', 'Widowed'] as $option)
                            <option value="{{ $option }}" {{ old('marital_status') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('marital_status') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Highest Qualification --}}
                <div>
                    <label for="highest_qualification" class="block text-[#3B3738] font-semibold">Highest Qualification</label>
                    <input type="text" name="highest_qualification" id="highest_qualification" value="{{ old('highest_qualification') }}" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
                    @error('highest_qualification') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Company Position --}}
                <div>
                    <label for="company_position" class="block text-[#3B3738] font-semibold">Company Position</label>
                    <input type="text" name="company_position" id="company_position" value="{{ old('company_position') }}" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
                    @error('company_position') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Height --}}
                <div>
                    <label for="height" class="block text-[#3B3738] font-semibold">Height (cm)</label>
                    <input type="number" name="height" id="height" value="{{ old('height') }}" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" min="100" max="250" />
                    @error('height') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Weight --}}
                <div>
                    <label for="weight" class="block text-[#3B3738] font-semibold">Weight (kg)</label>
                    <input type="number" name="weight" id="weight" value="{{ old('weight') }}" class="rounded-lg border border-[#C63D0F] px-4 py-2 w-full focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" min="20" max="200" />
                    @error('weight') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2 mt-4">
                    <button type="submit" class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold rounded-full py-3 text-lg shadow transition">
                        Complete Registration
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stateSelect = document.getElementById('state-dropdown');
    const citySelect = document.getElementById('city-dropdown');
    if (stateSelect && citySelect) {
        stateSelect.addEventListener('change', function() {
            const stateId = this.value;
            citySelect.innerHTML = '<option value="">Loading…</option>';
            fetch(`/api/cities?state_id=${stateId}`)

                .then(res => res.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="">Select City</option>';
                    for (const [id, name] of Object.entries(data)) {
                        citySelect.innerHTML += `<option value="${id}">${name}</option>`;
                    }
                });
        });
    }
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const religionDropdown = document.getElementById('religion-dropdown');
        const casteDropdown = document.getElementById('caste-dropdown');

        religionDropdown.addEventListener('change', function () {
            const religionId = this.value;
            casteDropdown.innerHTML = '<option value="">Loading...</option>';

            if (religionId) {
                fetch(`/api/castes?religion_id=${religionId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Select Caste</option>';
                        for (const [id, name] of Object.entries(data)) {
                            options += `<option value="${id}">${name}</option>`;
                        }
                        casteDropdown.innerHTML = options;
                    });
            } else {
                casteDropdown.innerHTML = '<option value="">Select Caste</option>';
            }
        });
    });
</script>


@endsection
