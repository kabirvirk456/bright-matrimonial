@extends('profile.layout')

@section('section_content')
<div class="bg-white rounded-3xl shadow-2xl p-12 max-w-4xl mx-auto border border-pink-100">
    <h1 class="text-2xl font-extrabold mb-8 tracking-tight text-pink-600 text-center">Personal Information</h1>

    @if(session('success'))
        <div class="mb-6 text-green-700 font-semibold bg-green-50 border border-green-200 px-4 py-3 rounded-lg text-center shadow">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 text-red-700 font-semibold bg-red-50 border border-red-200 px-4 py-3 rounded-lg text-center shadow">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('profile.personal-info.update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">

            {{-- Religion --}}
<div>
    <label class="block mb-2 text-pink-700 font-semibold">Religion</label>
    <select name="religion_id" id="religion-dropdown"
        class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30"
        required>
        <option value="">Select Religion</option>
        @foreach($religions as $id => $name)
            <option value="{{ $id }}" {{ old('religion_id', $profile->religion_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('religion_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
</div>

{{-- Caste --}}
<div>
    <label class="block mb-2 text-pink-700 font-semibold">Caste</label>
    <select name="caste_id" id="caste-dropdown"
        class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30"
        required>
        <option value="">Select Caste</option>
        @foreach($castes as $id => $name)
            <option value="{{ $id }}" {{ old('caste_id', $profile->caste_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('caste_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
</div>


          {{-- State --}}
<div>
    <label class="block mb-2 text-pink-700 font-semibold">State</label>
    <select name="state_id" id="state-dropdown"
        class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30">
        <option value="">Select State</option>
        @foreach($states as $id => $name)
            <option value="{{ $id }}" {{ old('state_id', $profile->state_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

{{-- City --}}
<div>
    <label class="block mb-2 text-pink-700 font-semibold">City You Live In</label>
    <select name="city_id" id="city-dropdown"
        class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30">
        <option value="">Select City</option>
        {{-- JS will update these options --}}
    </select>
</div>


            {{-- Mother Tongue --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Mother Tongue</label>
                <select name="mother_tongue_id" class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30">
                    <option value="">Select Mother Tongue</option>
                    @foreach($motherTongues as $id => $name)
                        <option value="{{ $id }}" {{ old('mother_tongue_id', $profile->mother_tongue_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Live with Family --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Do You Live With Family?</label>
                @php
                    $liveWithFamilyValue = old('live_with_family');
                    if ($liveWithFamilyValue === null) {
                        if (isset($profile) && $profile->live_with_family !== null) {
                            $liveWithFamilyValue = $profile->live_with_family === true || $profile->live_with_family === 1 || $profile->live_with_family === "1"
                                ? "1"
                                : ($profile->live_with_family === false || $profile->live_with_family === 0 || $profile->live_with_family === "0"
                                    ? "0"
                                    : ''
                                );
                        } else {
                            $liveWithFamilyValue = '';
                        }
                    }
                @endphp

                <select name="live_with_family" class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30">
                    <option value="">Select</option>
                    <option value="1" {{ $liveWithFamilyValue === "1" ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $liveWithFamilyValue === "0" ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Marital Status</label>
                <input name="marital_status" value="{{ old('marital_status', $profile->marital_status ?? '') }}"
                       class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30" />
            </div>
            <div>
                <label for="diet" class="block mb-2 text-pink-700 font-semibold">Diet</label>
                <select name="diet" id="diet" class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30">
                    <option value="">Select Diet</option>
                    <option value="veg" {{ old('diet', $profile->diet ?? '') == 'veg' ? 'selected' : '' }}>Vegetarian</option>
                    <option value="non-veg" {{ old('diet', $profile->diet ?? '') == 'non-veg' ? 'selected' : '' }}>Non-Vegetarian</option>
                    <option value="jain" {{ old('diet', $profile->diet ?? '') == 'jain' ? 'selected' : '' }}>Jain</option>
                    <option value="eggetarian" {{ old('diet', $profile->diet ?? '') == 'eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Height (cm)</label>
                <input name="height" value="{{ old('height', $profile->height ?? '') }}"
                       class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30" />
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Weight (kg)</label>
                <input name="weight" value="{{ old('weight', $profile->weight ?? '') }}"
                       class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30" />
            </div>
        </div>

        <div class="mb-8">
            <label class="block mb-2 text-pink-700 font-semibold">About</label>
            <textarea name="about" rows="3"
                class="w-full border border-pink-100 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 bg-pink-50/30">{{ old('about', $profile->about ?? '') }}</textarea>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white px-10 py-2 rounded-full shadow-lg font-bold text-lg hover:from-pink-600 hover:to-fuchsia-700 transition-all">
                Save
            </button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $('#religion-dropdown').change(function() {
        var religionId = $(this).val();
        $('#caste-dropdown').html('<option value="">Loading...</option>');

        if(religionId) {
            $.ajax({
                url: '/api/castes',
                type: 'GET',
                data: { religion_id: religionId },
                success: function(castes) {
                    let options = '<option value="">Select Caste</option>';
                    $.each(castes, function(id, name) {
                        options += `<option value="${id}">${name}</option>`;
                    });
                    $('#caste-dropdown').html(options);
                },
                error: function() {
                    $('#caste-dropdown').html('<option value="">Select Caste</option>');
                }
            });
        } else {
            $('#caste-dropdown').html('<option value="">Select Caste</option>');
        }
    });

    // Optionally: trigger on page load if religion is already selected
    var presetReligion = $('#religion-dropdown').val();
    var presetCaste = "{{ old('caste_id', $profile->caste_id ?? '') }}";
    if(presetReligion){
        $('#religion-dropdown').trigger('change');
        // Delay setting the caste until options are loaded
        setTimeout(function() {
            $('#caste-dropdown').val(presetCaste);
        }, 500);
    }
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $('#state-dropdown').change(function() {
        var stateId = $(this).val();
        $('#city-dropdown').html('<option value="">Loading...</option>');

        if(stateId) {
            $.ajax({
                url: '/api/cities',
                type: 'GET',
                data: { state_id: stateId },
                success: function(cities) {
                    let options = '<option value="">Select City</option>';
                    $.each(cities, function(id, name) {
                        options += `<option value="${id}">${name}</option>`;
                    });
                    $('#city-dropdown').html(options);
                },
                error: function() {
                    $('#city-dropdown').html('<option value="">Select City</option>');
                }
            });
        } else {
            $('#city-dropdown').html('<option value="">Select City</option>');
        }
    });

    // On page load: If state is already selected (edit profile)
    var presetState = $('#state-dropdown').val();
    var presetCity = "{{ old('city_id', $profile->city_id ?? '') }}";
    if (presetState) {
        $('#state-dropdown').trigger('change');
        setTimeout(function() {
            $('#city-dropdown').val(presetCity);
        }, 500);
    }
});
</script>

@endsection
