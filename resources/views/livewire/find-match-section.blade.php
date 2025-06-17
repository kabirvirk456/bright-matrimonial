<div class="w-full max-w-4xl mx-auto py-12 px-2">
    <h2 class="text-3xl md:text-4xl font-extrabold text-center text-[#44303E] mb-8 tracking-tight">
        Find Match By
    </h2>
    <!-- Tabs -->
    <div class="flex justify-center flex-wrap gap-4 mb-8">
        @foreach ($filters as $tab => $categories)
            <button
                wire:click="selectTab('{{ $tab }}')"
                class="px-6 py-3 rounded-full font-bold text-lg transition-all border-2
                {{ $activeTab === $tab ? 'border-[#B83240] text-white bg-[#B83240] shadow-xl' : 'border-[#B83240]/30 text-[#B83240] bg-white hover:bg-[#F4E6E7]' }}">
                {{ strtoupper($tab) }}
            </button>
        @endforeach
    </div>
    <!-- Sub Categories -->
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        @foreach ($filters[$activeTab] as $cat)
            <button
                wire:click="selectCategory('{{ $cat }}')"
                class="px-5 py-2 rounded-full border transition
                {{ $activeCategory === $cat ? 'border-[#B83240] bg-[#B83240] text-white font-bold' : 'border-[#B83240]/30 bg-white text-[#B83240] hover:bg-[#F4E6E7]' }}">
                {{ $cat }}
            </button>
        @endforeach
    </div>

    <!-- Profiles Grid: 3 in a row, 2 rows MAX, true square card as per sketch -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">
        @foreach ($profiles->take(6) as $profile)
            <div class="bg-white border border-[#B83240]/20 rounded-xl shadow-lg flex flex-col items-center justify-between aspect-square w-64 max-w-full mx-auto">
                <div class="flex-1 flex flex-col items-center justify-center w-full">
                    <div class="w-32 h-32 rounded-lg overflow-hidden flex items-center justify-center bg-[#F4E6E7] mt-6">
                        @if($profile->photo_path)
                            <img src="{{ asset('storage/' . $profile->photo_path) }}" class="object-cover w-full h-full" alt="Profile Photo">
                        @else
                            <span class="text-6xl font-bold text-[#B83240]">
                                {{ strtoupper(substr($profile->user->first_name ?? 'U', 0, 1)) }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="w-full bg-[#FFF1F2] rounded-b-xl px-4 py-3 text-center border-t">
                    <div class="text-lg font-extrabold text-[#44303E] leading-none">
                        {{ $profile->user->first_name ?? '-' }}
                    </div>
                    <div class="text-base text-[#B83240] font-semibold leading-tight">
                        Age: {{ $profile->birth_date ? \Carbon\Carbon::parse($profile->birth_date)->age : '-' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
