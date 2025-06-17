@extends('profile.layout')

@section('section_content')
<div class="bg-white rounded-3xl shadow-2xl p-12 max-w-4xl mx-auto border border-pink-100">
    <h1 class="text-2xl font-extrabold mb-8 tracking-tight text-pink-600 text-center">Family Details</h1>

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

    <form method="POST" action="{{ route('profile.family-details.update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
            {{-- Family Type --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Family Type</label>
                <select name="family_type" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Family Type</option>
                    <option value="Nuclear" {{ old('family_type', $profile->family_type ?? '') == 'Nuclear' ? 'selected' : '' }}>Nuclear</option>
                    <option value="Joint" {{ old('family_type', $profile->family_type ?? '') == 'Joint' ? 'selected' : '' }}>Joint</option>
                    <option value="Extended" {{ old('family_type', $profile->family_type ?? '') == 'Extended' ? 'selected' : '' }}>Extended</option>
                    <option value="Other" {{ old('family_type', $profile->family_type ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- Number of Siblings --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Number of Siblings</label>
                <input name="siblings" type="number" min="0" value="{{ old('siblings', $profile->siblings ?? '') }}"
                    class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>

            {{-- Mother's Occupation --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Mother's Occupation</label>
                <input name="mother_occupation" value="{{ old('mother_occupation', $profile->mother_occupation ?? '') }}"
                    class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>

            {{-- Father's Occupation --}}
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Father's Occupation</label>
                <input name="father_occupation" value="{{ old('father_occupation', $profile->father_occupation ?? '') }}"
                    class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
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
