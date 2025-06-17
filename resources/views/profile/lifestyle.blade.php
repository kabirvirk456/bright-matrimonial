@extends('profile.layout')

@section('section_content')
<div class="bg-white rounded-3xl shadow-2xl p-12 max-w-4xl mx-auto border border-pink-100">
    <h1 class="text-2xl font-extrabold mb-8 tracking-tight text-pink-600 text-center">Lifestyle</h1>
    <form method="POST" action="{{ route('profile.lifestyle.update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            {{-- Drinking Habits --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Drinking Habits</label>
                <select name="drinking_habits" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select</option>
                    <option value="no" {{ old('drinking_habits', $profile->drinking_habits ?? '') == 'no' ? 'selected' : '' }}>No</option>
                    <option value="occasionally" {{ old('drinking_habits', $profile->drinking_habits ?? '') == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                    <option value="yes" {{ old('drinking_habits', $profile->drinking_habits ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            {{-- Smoking Habits --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Smoking Habits</label>
                <select name="smoking_habits" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select</option>
                    <option value="no" {{ old('smoking_habits', $profile->smoking_habits ?? '') == 'no' ? 'selected' : '' }}>No</option>
                    <option value="occasionally" {{ old('smoking_habits', $profile->smoking_habits ?? '') == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                    <option value="yes" {{ old('smoking_habits', $profile->smoking_habits ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            {{-- Open to Pets --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Open to Pets</label>
                <select name="open_to_pets" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select</option>
                    <option value="1" {{ old('open_to_pets', $profile->open_to_pets ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('open_to_pets', $profile->open_to_pets ?? '') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            {{-- Languages Spoken --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Languages Spoken</label>
                <select id="languages_spoken" name="languages_spoken[]" multiple class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    @php
                        $selectedLanguages = old('languages_spoken', $profile->languages_spoken ?? []);
                        if (is_string($selectedLanguages)) {
                            $selectedLanguages = json_decode($selectedLanguages, true) ?: [];
                        }
                        if ($selectedLanguages === null) {
                            $selectedLanguages = [];
                        }
                    @endphp

                    <option value="English" {{ in_array('English', $selectedLanguages) ? 'selected' : '' }}>English</option>
                    <option value="Hindi" {{ in_array('Hindi', $selectedLanguages) ? 'selected' : '' }}>Hindi</option>
                    <option value="Marathi" {{ in_array('Marathi', $selectedLanguages) ? 'selected' : '' }}>Marathi</option>
                    <option value="Gujarati" {{ in_array('Gujarati', $selectedLanguages) ? 'selected' : '' }}>Gujarati</option>
                    <option value="Other" {{ in_array('Other', $selectedLanguages) ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>
        <div class="mt-10 flex justify-center">
            <button type="submit" class="bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white px-10 py-2 rounded-full shadow-lg font-bold text-lg hover:from-pink-600 hover:to-fuchsia-700 transition-all">
                Save
            </button>
        </div>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Choices('#languages_spoken', {
        removeItemButton: true,
        placeholder: true,
        placeholderValue: 'Select languages',
        searchEnabled: false
    });
});
</script>
@endsection
