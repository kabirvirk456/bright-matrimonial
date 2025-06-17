@php
    $profile = auth()->user()->profile;
    $user = auth()->user();
@endphp

<div class="flex items-center gap-8 bg-white rounded-2xl shadow px-8 py-4 mt-6 ml-10 max-w-5xl">
    {{-- Profile Photo --}}
    <div>
        <img src="{{ $profile->photo_path ? asset('storage/'.$profile->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" class="rounded-full object-cover h-20 w-20 border" />
        <form action="{{ route('profile.photo.upload') }}" method="POST" enctype="multipart/form-data" class="mt-2 flex flex-col items-center gap-1">
            @csrf
            <input type="file" name="profile_photo" class="hidden" id="profilePhotoInput" accept="image/*" onchange="this.form.submit()">
            <label for="profilePhotoInput" class="cursor-pointer bg-pink-100 px-2 py-1 rounded text-xs">Upload</label>
        </form>
    </div>

    {{-- Live Selfie + Verification --}}
    <div>
        <div>Take a Live Selfie:</div>
        {{-- Selfie Upload Form --}}
        <form id="selfie-upload-form" action="{{ route('profile.upload.selfie') }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="selfie_photo" id="selfie_photo">
    <button type="button" class="bg-pink-200 px-3 py-1 rounded text-xs mt-1" id="open-camera-btn">Capture</button>
</form>


        {{-- Always show verify button --}}
        <form id="verify-form" action="{{ route('profile.verify.photo') }}" method="POST" class="inline mt-2" style="display:inline;">
            @csrf
            <button
                type="submit"
                class="bg-orange-400 px-3 py-1 rounded text-xs ml-2"
            >
                Verify Photo
            </button>
        </form>

        {{-- Show selfie preview and debug path if exists --}}
        @if($user->selfie_photo_path)
            <div class="flex flex-col items-center mt-2">
                <img src="{{ asset('storage/' . $user->selfie_photo_path) }}" class="w-24 h-24 rounded-full border-2 border-green-500" style="object-fit: cover;">
                <div class="text-xs text-gray-400 mt-1">Selfie Preview</div>
                <div class="text-xs text-gray-400">Selfie Path: {{ $user->selfie_photo_path }}</div>
            </div>
        @endif

        <div id="selfie-capture-message" class="mt-2"></div>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="text-green-600 mt-2 font-semibold">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="text-red-600 mt-2 font-semibold">{{ session('error') }}</div>
        @endif
    </div>

    {{-- Camera Preview Area --}}
    <div id="camera-section" class="mt-4" style="display:none;">
        <video id="camera" width="200" height="160" autoplay class="rounded border"></video>
        <br>
        <button type="button" id="take-photo" class="bg-blue-500 text-white px-3 py-1 rounded mt-2">Take Photo</button>
        <button type="button" id="close-camera" class="bg-gray-300 px-3 py-1 rounded mt-2">Close</button>
        <canvas id="selfie-canvas" width="200" height="160" style="display:none;"></canvas>
    </div>

    {{-- Name & Email --}}
    <div class="flex-1">
        <div class="font-bold text-lg">{{ $user->name ?? $user->email }}</div>
        <div class="text-sm text-gray-600">{{ $user->email }}</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let stream = null;
    const openBtn = document.getElementById('open-camera-btn');
    const cameraSection = document.getElementById('camera-section');
    const video = document.getElementById('camera');
    const takeBtn = document.getElementById('take-photo');
    const closeBtn = document.getElementById('close-camera');
    const canvas = document.getElementById('selfie-canvas');
    const selfieInput = document.getElementById('selfie_photo');
    const selfieForm = document.getElementById('selfie-upload-form');
    const captureMsg = document.getElementById('selfie-capture-message');

    // Open camera when "Capture" is clicked
    openBtn.onclick = function () {
        cameraSection.style.display = 'block';
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(s => {
                stream = s;
                video.srcObject = stream;
                video.play();
            }).catch(e => {
                alert('Camera access denied: ' + e.message);
            });
    };

    // Take photo
    takeBtn.onclick = function () {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        let dataUrl = canvas.toDataURL('image/png');
        selfieInput.value = dataUrl;
        cameraSection.style.display = 'none';
        if (stream) stream.getTracks().forEach(track => track.stop());
        captureMsg.innerHTML = '<span class="text-green-700 text-xs font-semibold">Selfie captured! Uploading…</span>';
        selfieForm.submit();
    };

    // Close camera
    closeBtn.onclick = function () {
        cameraSection.style.display = 'none';
        if (stream) stream.getTracks().forEach(track => track.stop());
    };
});
</script>
