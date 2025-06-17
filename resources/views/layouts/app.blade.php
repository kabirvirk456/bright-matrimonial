<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        @yield('content')
    </div>

    <!-- Camera Section JS (leave as is, safe) -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const cameraSection = document.getElementById('camera-section');
        const startCameraBtn = document.getElementById('start-camera');
        const takePhotoBtn = document.getElementById('take-photo');
        const closeCameraBtn = document.getElementById('close-camera');
        const video = document.getElementById('camera');
        const canvas = document.getElementById('selfie-canvas');
        const selfieInput = document.getElementById('selfie-photo');
        let stream;

        if(startCameraBtn) {
            startCameraBtn.onclick = function () {
                cameraSection.style.display = 'block';
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(s => {
                        stream = s;
                        video.srcObject = stream;
                        video.play();
                    }).catch(e => {
                        alert('Camera access denied!');
                    });
            };
        }
        if(closeCameraBtn) {
            closeCameraBtn.onclick = function () {
                cameraSection.style.display = 'none';
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            };
        }
        if(takePhotoBtn) {
            takePhotoBtn.onclick = function () {
                canvas.style.display = 'block';
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                // Save to hidden input for form submission
                selfieInput.value = canvas.toDataURL('image/png');
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
                cameraSection.style.display = 'none';
            };
        }
    });
    </script>
    
    {{-- Place Livewire scripts here, before closing body --}}
    @livewireScripts
</body>
</html>
