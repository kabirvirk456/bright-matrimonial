@extends('profile.layout')

@section('section_content')
<div class="bg-white rounded-3xl shadow-2xl p-12 max-w-4xl mx-auto border border-pink-100">
    <h1 class="text-2xl font-extrabold mb-8 tracking-tight text-pink-600 text-center">Horoscope</h1>
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
    <form method="POST" action="{{ route('profile.horoscope.update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">

            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Birth Place</label>
                <input name="birth_place" value="{{ old('birth_place', $profile->birth_place ?? '') }}"
                       class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Birth Date</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', $profile->birth_date ?? '') }}"
                       class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Birth Time</label>
                <input type="time" name="birth_time" value="{{ old('birth_time', $profile->birth_time ?? '') }}"
                       class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Zodiac Sign</label>
                <select name="zodiac_sign" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Zodiac Sign</option>
                    @foreach([
                        'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
                        'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
                    ] as $sign)
                        <option value="{{ $sign }}" {{ old('zodiac_sign', $profile->zodiac_sign ?? '') == $sign ? 'selected' : '' }}>{{ $sign }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Manglik Dosh</label>
                <select name="manglik_dosh" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Option</option>
                    <option value="Yes" {{ old('manglik_dosh', $profile->manglik_dosh ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('manglik_dosh', $profile->manglik_dosh ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    <option value="Partial" {{ old('manglik_dosh', $profile->manglik_dosh ?? '') == 'Partial' ? 'selected' : '' }}>Partial</option>
                    <option value="Don't Know" {{ old('manglik_dosh', $profile->manglik_dosh ?? '') == "Don't Know" ? 'selected' : '' }}>Don't Know</option>
                </select>
            </div>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white px-10 py-2 rounded-full shadow-lg font-bold text-lg hover:from-pink-600 hover:to-fuchsia-700 transition-all">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
