<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css') {{-- If you're using Vite for asset bundling --}}
</head>

<body class=" text-white font-sans min-h-screen flex flex-col">
    {{-- Include the header --}}
    @include('header')

    <div class="flex-grow flex flex-col items-center justify-center">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold md:text-5xl mb-4 animate-fade-in-down">Welcome to Sakshi Enterprises</h1>
            <p class="text-lg md:text-xl text-gray-200">Manage and create bills with ease</p>
        </div>

        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="hidden md:block md:mr-6">
                <img src="https://i.pinimg.com/originals/46/71/c6/4671c6bfaa611757647e91a3aca2ba4f.gif" alt="Bouncing Image" class="animate-bounce w-48 md:w-64">
            </div>
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <a href="{{ route('existing-bills') }}"
                    class="bg-blue-600 hover:bg-blue-800 text-white px-8 py-4 rounded-md shadow-lg transition-transform transform hover:-translate-y-1 hover:scale-105 duration-300">
                    View Existing Bills
                </a>
                <a href="{{ route('new-bill') }}"
                    class="bg-green-600 hover:bg-green-800 text-white px-8 py-4 rounded-md shadow-lg transition-transform transform hover:-translate-y-1 hover:scale-105 duration-300">
                    Create New Bill
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mt-8 bg-green-500 text-white p-4 rounded-md shadow-md">
                <p>{{ session('success') }}</p>
            </div>
        @endif
    </div>

    {{-- Include the footer --}}
    @include('footer')
</body>

</html>
