@extends('profile.layout')
@section('content')
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-3xl mx-auto mt-10">
        <h1 class="text-2xl font-extrabold text-[#C63D0F] mb-6 text-center">Desired Partner Preferences</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.desired-partner.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Desired Age</label>
                <input name="desired_age" value="{{ old('desired_age', $profile->desired_age) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Relation Type</label>
                <input name="desired_relation_type" value="{{ old('desired_relation_type', $profile->desired_relation_type) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Religion</label>
                <input name="desired_religion" value="{{ old('desired_religion', $profile->desired_religion) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Mother Tongue</label>
                <input name="desired_mother_tongue" value="{{ old('desired_mother_tongue', $profile->desired_mother_tongue) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Diet</label>
                <input name="desired_diet" value="{{ old('desired_diet', $profile->desired_diet) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">State</label>
                <input name="desired_state" value="{{ old('desired_state', $profile->desired_state) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">City</label>
                <input name="desired_city" value="{{ old('desired_city', $profile->desired_city) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Highest Qualification</label>
                <input name="desired_highest_qualification" value="{{ old('desired_highest_qualification', $profile->desired_highest_qualification) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>
            <div>
                <label class="block mb-2 font-semibold text-gray-700">Income</label>
                <input name="desired_income" value="{{ old('desired_income', $profile->desired_income) }}"
                       class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
            </div>

            <div class="md:col-span-2 mt-4">
                <button type="submit"
                    class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold py-3 rounded-xl text-lg shadow transition">
                    Save Preferences
                </button>
            </div>
        </form>
    </div>
@endsection
