@extends('profile.layout')
@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-2xl rounded-2xl p-8 mt-10">
        <h2 class="text-2xl font-extrabold text-[#C63D0F] mb-8 text-center">Edit Profile</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Gender --}}
            <div>
                <label for="gender" class="block mb-2 font-semibold text-gray-700">Gender</label>
                <select id="gender" name="gender" class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition">
                    @foreach(['male','female','other'] as $g)
                        <option value="{{ $g }}" {{ old('gender', $profile->gender) === $g ? 'selected' : '' }}>
                            {{ ucfirst($g) }}
                        </option>
                    @endforeach
                </select>
                @error('gender')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Date of Birth --}}
            <div>
                <label for="dob" class="block mb-2 font-semibold text-gray-700">Date of Birth</label>
                <input id="dob" name="dob" type="date" value="{{ old('dob', $profile->dob) }}"
                    class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
                @error('dob')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- City --}}
            <div>
                <label for="city" class="block mb-2 font-semibold text-gray-700">City</label>
                <input id="city" name="city" type="text" value="{{ old('city', $profile->city) }}"
                    class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
                @error('city')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Bio --}}
            <div>
                <label for="bio" class="block mb-2 font-semibold text-gray-700">Bio</label>
                <textarea id="bio" name="bio" rows="4"
                    class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition">{{ old('bio', $profile->bio) }}</textarea>
                @error('bio')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Profile Photo --}}
            <div>
                <label for="photo" class="block mb-2 font-semibold text-gray-700">Profile Photo</label>
                <input id="photo" name="photo" type="file"
                    class="w-full border border-[#C63D0F] rounded-lg px-4 py-2 text-gray-700 focus:ring-2 focus:ring-[#FFF056] focus:border-[#FFF056] transition" />
                @if($profile->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$profile->photo) }}" alt="Photo"
                            class="h-20 w-20 object-cover rounded-full border-2 border-[#C63D0F] shadow">
                    </div>
                @endif
                @error('photo')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-[#C63D0F] hover:bg-[#FFF056] hover:text-[#3B3738] text-white font-bold py-3 rounded-xl text-lg shadow transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
