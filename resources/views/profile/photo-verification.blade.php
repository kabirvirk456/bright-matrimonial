{{-- resources/views/profile/photo-verification.blade.php --}}
<x-app-layout>
    <div class="max-w-lg mx-auto my-10 p-6 bg-white rounded shadow border">
        <h2 class="text-xl font-bold mb-4 text-[#C63D0F] text-center">Photo Verification</h2>
        <div class="flex flex-col items-center gap-4">
            <div>
                <img src="{{ asset('storage/' . $user->profile->photo_path) }}" alt="Profile Photo"
                     class="rounded-full w-32 h-32 object-cover border shadow">
                <p class="text-sm text-center mt-2 font-semibold">Profile Photo</p>
            </div>

            <div id="preview"></div>

            <form id="verify-form" method="POST" action="{{ route('profile.verify.photo') }}">
                @csrf
                <input type="hidden" name="selfie_photo" id="selfie_photo">
                <div class="flex flex-col items-center gap-2 mt-3">
                    <video id="video" width="220" height="170" autoplay style="border:1px solid #333;display:none;"></video>
                    <canvas id="canvas" width="220" height="170" style="display:none;"></canvas>
                    <button type="button" id="start-btn" class="px-4 py-2 bg-blue-600 text-white rounded">Start Camera</button>
                    <button type="button" id="capture-btn" class="px-4 py-2 bg-green-600 text-white rounded" style="display:none;">Capture Selfie</button>
                    <button type="submit" id="verify-btn" class="px-4 py-2 bg-[#C63D0F] text-white rounded" style="display:none;">Verify Photo</button>
                </div>
            </form>

            {{-- Session messages --}}
@if(session('success'))
    <div class="text-green-600 font-semibold mt-3">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="text-red-600 font-semibold mt-3">{{ session('error') }}</div>
@endif

{{-- Stepwise status messages and verify button --}}
@if($user->profile->photo_path && !$user->profile->selfie_photo_path)
    <div class="alert alert-info mt-3">Profile photo uploaded! Next, capture and upload your selfie below.</div>
@endif

@if($user->profile->photo_path && $user->profile->selfie_photo_path && $user->profile->photo_verification_status !== 'verified')
    <div class="alert alert-info mt-3">Selfie uploaded! Now, click the <b>Verify</b> button below to complete verification.</div>
    <form action="{{ route('profile.verify.photo') }}" method="POST" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-primary px-4 py-2 bg-[#C63D0F] text-white rounded">Verify Photo</button>
    </form>
@endif

@if($user->profile->photo_verification_status == 'verified')
    <div class="alert alert-success mt-3">Your photo is verified ✅</div>
@endif

    <script>
        let stream = null;
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const startBtn = document.getElementById('start-btn');
        const captureBtn = document.getElementById('capture-btn');
        const verifyBtn = document.getElementById('verify-btn');
        const selfieInput = document.getElementById('selfie_photo');
        const preview = document.getElementById('preview');

        startBtn.onclick = function () {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(s => {
                    stream = s;
                    video.srcObject = stream;
                    video.style.display = 'block';
                    captureBtn.style.display = 'inline-block';
                    startBtn.style.display = 'none';
                    preview.innerHTML = '';
                    verifyBtn.style.display = 'none';
                })
                .catch(e => {
                    alert('Camera access denied: ' + e.message);
                });
        };

        captureBtn.onclick = function () {
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            let dataUrl = canvas.toDataURL('image/png');
            selfieInput.value = dataUrl;
            preview.innerHTML = '<img src="'+dataUrl+'" class="rounded shadow border w-32 mt-2">';
            if (stream) stream.getTracks().forEach(track => track.stop());
            video.style.display = 'none';
            captureBtn.style.display = 'none';
            startBtn.style.display = 'inline-block';
            verifyBtn.style.display = 'inline-block';
        };

        window.addEventListener('beforeunload', function(){
            if (stream) stream.getTracks().forEach(track => track.stop());
        });
    </script>
</x-app-layout>
