@extends('profile.layout')
@section('section_content')
<div class="bg-white rounded-3xl shadow-2xl p-12 max-w-4xl mx-auto border border-pink-100">
    <h1 class="text-2xl font-extrabold mb-8 tracking-tight text-pink-600 text-center">Likes</h1>
    <form method="POST" action="{{ route('profile.likes.update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-8">

            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Hobbies</label>
                <select name="hobbies" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Hobby</option>
                    @foreach($hobbyList as $id => $name)
                        <option value="{{ $name }}" {{ old('hobbies', $profile->hobbies ?? '') == $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Favorite Music</label>
                <select name="favorite_music" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Favorite Music</option>
                    @foreach($musicList as $id => $name)
                        <option value="{{ $name }}" {{ old('favorite_music', $profile->favorite_music ?? '') == $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Favorite Books</label>
                <select name="favorite_books" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Favorite Book</option>
                    @foreach($bookList as $id => $name)
                        <option value="{{ $name }}" {{ old('favorite_books', $profile->favorite_books ?? '') == $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Favorite Movies</label>
                <select name="favorite_movies" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Favorite Movie</option>
                    @foreach($movieList as $id => $name)
                        <option value="{{ $name }}" {{ old('favorite_movies', $profile->favorite_movies ?? '') == $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-pink-700 font-semibold">Favorite Sports</label>
                <select name="favorite_sports" class="w-full border border-pink-100 rounded-xl px-4 py-2 bg-pink-50/30 focus:ring-2 focus:ring-pink-400 focus:border-pink-400">
                    <option value="">Select Favorite Sport</option>
                    @foreach($sportList as $id => $name)
                        <option value="{{ $name }}" {{ old('favorite_sports', $profile->favorite_sports ?? '') == $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
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
