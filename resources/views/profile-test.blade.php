<!DOCTYPE html>
<html>
<head>
    <title>Minimal Profile Card Test</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-6">Test: Only Name & Age</h1>
        <div class="grid grid-cols-1 gap-4">
            @foreach ($profiles as $profile)
                <div class="border p-4 rounded shadow flex items-center">
                    <div>
                        <div class="font-semibold">
                            {{ $profile->user->first_name ?? 'N/A' }}
                            {{ $profile->user->last_name ?? '' }}
                        </div>
                        <div class="text-gray-600 text-sm">
                            Age: 
                            @if ($profile->calculated_age)
                                {{ $profile->calculated_age }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
