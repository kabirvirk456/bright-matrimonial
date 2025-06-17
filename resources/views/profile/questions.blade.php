@extends('profile.layout')

@section('section_content')
@php
    // User is always logged in (route is protected)
    $gender = auth()->user()->gender;

    // Fetch gender-specific and general questions
    $questions = \App\Models\Question::whereIn('gender', [$gender, 'general'])
        ->orderBy('order')
        ->limit(21)
        ->get();
@endphp

<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-extrabold mb-8 tracking-tight text-pink-600 text-center">Answer These 21 Questions</h2>

    @if($questions->count() === 0)
        <div class="mb-6 p-4 bg-yellow-50 text-yellow-800 rounded-2xl shadow text-center font-semibold">
            No questions found for your profile.<br>Please contact support.
        </div>
    @else
        <form method="POST" action="{{ route('profile.saveQuestions') }}">
            @csrf

            @foreach($questions as $question)
                <div class="mb-8 p-6 bg-white rounded-3xl shadow-lg border border-pink-100">
                    <div class="font-bold text-pink-700 mb-4 text-lg">
                        {{ $loop->iteration }}. {{ $question->text }}
                    </div>
                    <div class="flex flex-col gap-3">
                        @php
                            $options = is_array($question->options)
                                ? $question->options
                                : (json_decode($question->options, true) ?: []);
                        @endphp

                        @foreach($options as $option)
                            <label class="flex items-center gap-3 px-4 py-2 rounded-lg border border-pink-100 bg-pink-50/50 hover:bg-pink-100 cursor-pointer transition-all text-base">
                                <input type="radio"
                                       name="answers[{{ $question->id }}]"
                                       value="{{ is_array($option) ? $option['option'] : $option }}"
                                       required
                                       class="accent-pink-500 w-5 h-5">
                                <span>{{ is_array($option) ? $option['option'] : $option }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex justify-center mt-10">
                <button type="submit" class="bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white px-10 py-3 rounded-full shadow-lg font-bold text-lg hover:from-pink-600 hover:to-fuchsia-700 transition-all">
                    Save Answers
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
