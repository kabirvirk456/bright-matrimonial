{{-- resources/views/partials/hero-banner.blade.php --}}

<section class="relative min-h-[480px] flex items-center justify-center"
         style="background-image: url('/images/your-hero.jpg'); background-size: cover; background-position: center;">
    <!-- Overlay for better contrast -->
    <div class="absolute inset-0 bg-[#3B3738] opacity-90"></div>
    
    <!-- Main hero content (centered) -->
    <div class="relative z-10 w-full max-w-4xl mx-auto text-center px-4 pt-20 pb-8">
        <h1 class="font-heading text-5xl md:text-6xl text-white mb-4 font-bold drop-shadow-lg">
            Find Your Perfect Match Today
        </h1>
        <p class="font-body text-xl text-[#889B89] mb-0 drop-shadow">
            Free to browse &amp; connect with thousands of singles.
        </p>
    </div>
    
    <!-- Search form absolutely positioned at the bottom of hero -->
    <div class="absolute left-1/2 bottom-0 transform -translate-x-1/2 translate-y-1/2 w-full max-w-3xl px-4 z-20">
        <form action="{{ route('matches.index') }}" method="GET"
              class="bg-white/90 p-4 rounded-xl shadow-md grid grid-cols-1 md:grid-cols-4 gap-4 backdrop-blur-sm">
            <select name="gender" class="form-select w-full rounded border-gray-300 focus:border-[#C63D0F] focus:ring-[#C63D0F]">
                <option value="">Any Gender</option>
                @foreach(['male','female','other'] as $g)
                    <option value="{{ $g }}">{{ ucfirst($g) }}</option>
                @endforeach
            </select>
            <input type="text" name="city" placeholder="City"
                   class="form-input w-full rounded border-gray-300 focus:border-[#C63D0F] focus:ring-[#C63D0F]" />
            <input type="number" name="age_min" placeholder="Min Age"
                   class="form-input w-full rounded border-gray-300 focus:border-[#C63D0F] focus:ring-[#C63D0F]" min="18" />
            <button type="submit"
                    class="bg-[#C63D0F] text-white rounded px-4 py-2 font-semibold hover:bg-[#3B3738] transition">
                Search
            </button>
        </form>
    </div>
</section>
