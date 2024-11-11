<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css') {{-- If you're using Vite for asset bundling --}}
</head>

<body>
    {{-- Include the header --}}
    @include('header')

    <div class="bg-black h-screen flex flex-col justify-center items-center">
        <div class="flex flex-row justify-center items-center">
            <div class="hidden md:block">
                <img src="{{ asset('images/chair.png') }}" alt="Bouncing Image" class="animate-bounce w-full h-auto" />
            </div>
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('existing-bills') }}"
                    class="bg-red-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-red-700 transition duration-300">
                    View Existing Bills
                </a>
                <a href="{{ route('new-bill') }}"
                    class="bg-red-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-red-600 transition duration-300">
                    Create New Bill
                </a>
            </div>
        </div>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif
    </div>

    {{-- Include the footer --}}
    @include('footer')
</body>

</html>