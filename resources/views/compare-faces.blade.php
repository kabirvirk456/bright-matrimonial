{{-- resources/views/compare-faces.blade.php --}}
<x-app-layout>
    <div class="max-w-xl mx-auto mt-12 p-8 bg-white rounded-lg shadow border">
        <h2 class="text-2xl font-bold mb-6 text-center text-[#C63D0F]">Compare Faces (Photo Verification)</h2>

        <form action="{{ route('compare.faces') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="source_image" class="block font-semibold mb-1">Source Image:</label>
                <input type="file" name="source_image" id="source_image" accept="image/*" required class="block w-full border rounded p-2">
            </div>
            <div>
                <label for="target_image" class="block font-semibold mb-1">Target Image:</label>
                <input type="file" name="target_image" id="target_image" accept="image/*" required class="block w-full border rounded p-2">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-[#C63D0F] text-white font-bold rounded hover:bg-[#3B3738] transition">
                Compare Faces
            </button>
        </form>

        @if(isset($result))
            <div class="mt-8 bg-gray-50 rounded-lg p-4 border border-[#C63D0F]">
                <h3 class="font-bold text-[#C63D0F] mb-2">Result:</h3>
                @if(isset($result['FaceMatches']) && count($result['FaceMatches']))
                    <div class="text-green-600 font-semibold mb-2">
                        ✅ Face Match Found!
                    </div>
                    <div class="text-sm text-gray-800">
                        Similarity: {{ $result['FaceMatches'][0]['Similarity'] ?? 'N/A' }}%
                    </div>
                @else
                    <div class="text-red-600 font-semibold mb-2">
                        ❌ No Face Match Found.
                    </div>
                @endif

                <details class="mt-3">
                    <summary class="cursor-pointer text-gray-500">Show Full Response (for debug)</summary>
                    <pre class="text-xs mt-2 bg-white p-2 rounded border">{{ print_r($result, true) }}</pre>
                </details>
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 text-red-500 font-semibold">
                {{ session('error') }}
            </div>
        @endif
    </div>
</x-app-layout>
