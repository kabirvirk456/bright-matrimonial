@extends('profile.layout')
@section('section_content')
<div class="bg-white rounded-3xl shadow-2xl p-12 max-w-4xl mx-auto border border-pink-100">
    <h1 class="text-2xl font-extrabold mb-8 tracking-tight text-pink-600 text-center">Education & Career</h1>
    <form method="POST" action="{{ route('profile.education-career.update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Highest Qualification</label>
                <input name="highest_qualification" value="{{ old('highest_qualification', $profile->highest_qualification) }}"
                    class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Company Name</label>
                <input name="company_name" value="{{ old('company_name', $profile->company_name) }}"
                    class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Company Position</label>
                <input name="company_position" value="{{ old('company_position', $profile->company_position) }}"
                    class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400" />
            </div>
            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Income (per annum)</label>
                <select name="income" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Income</option>
                    <option value="Under ₹3 Lakh" {{ old('income', $profile->income ?? '') == 'Under ₹3 Lakh' ? 'selected' : '' }}>Under ₹3 Lakh</option>
                    <option value="₹3-5 Lakh" {{ old('income', $profile->income ?? '') == '₹3-5 Lakh' ? 'selected' : '' }}>₹3-5 Lakh</option>
                    <option value="₹5-10 Lakh" {{ old('income', $profile->income ?? '') == '₹5-10 Lakh' ? 'selected' : '' }}>₹5-10 Lakh</option>
                    <option value="₹10-20 Lakh" {{ old('income', $profile->income ?? '') == '₹10-20 Lakh' ? 'selected' : '' }}>₹10-20 Lakh</option>
                    <option value="Above ₹20 Lakh" {{ old('income', $profile->income ?? '') == 'Above ₹20 Lakh' ? 'selected' : '' }}>Above ₹20 Lakh</option>
                    <option value="Prefer not to say" {{ old('income', $profile->income ?? '') == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
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
