<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sakshi Enterprises</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-r from-indigo-500 to-violet-300 p-4">

    <!-- Glassy Header -->
    <div class="flex items-center justify-center h-auto bg-transparent mt-4">
        <header class="w-full sm:w-3/5 py-4 bg-black bg-opacity-25 backdrop-filter backdrop-blur-lg text-white text-center font-extrabold text-5xl shadow-lg rounded-xl animate-fade-in">
            <h1 class="tracking-wider text-blue-500 drop-shadow-lg">
                Sakshi Enterprises
            </h1>
        </header>
    </div>

    <!-- Main Content -->
    <div class="flex justify-center items-center w-full h-full mt-8">
        <!-- Outer Wrapper for Centering -->
        <div class="w-full max-w-2xl lg:max-w-4xl p-6 bg-opacity-30 bg-white rounded-3xl shadow-2xl backdrop-filter backdrop-blur-lg">
            <div class="flex flex-col lg:flex-row justify-center items-center w-full space-y-6 lg:space-y-0 lg:space-x-10">

                <!-- Carousel Section -->
                <div class="w-full lg:w-1/2 p-4 sm:p-8 flex justify-center">
                    <div class="w-full max-w-md">
                        <div class="slider">
                            <div><img src="https://png.pngtree.com/png-vector/20240309/ourmid/pngtree-hvac-cooler-devices-design-illustration-png-image_11906717.png" alt="Slide 1" class="rounded-lg shadow-lg object-contain w-full max-h-64 sm:max-h-80 lg:max-h-full" /></div>
                        </div>
                    </div>
                </div>

                <!-- Login Form Section -->
                <div class="w-full lg:w-1/2 p-8 sm:p-10 bg-black bg-opacity-40 backdrop-blur-md rounded-3xl shadow-lg animate-fade-in">
                    <div class="flex justify-center mb-6 opacity-90 animate-slide-down">
                    <img src={{ asset('images/logo.png') }} alt="Sakshi Enterprises Logo" class="h-20 w-auto rounded-full shadow-lg border-2 border-grey sm:h-24" />
                    </div>

                    @if ($errors->any())
                        <p class="text-red-500 text-xs sm:text-sm mb-4 text-center">{{ $errors->first('error') }}</p>
                    @endif

                    <form method="POST" action="/login" class="space-y-4 sm:space-y-6">
                        @csrf
                        <div>
                            <label class="block text-gray-300 text-xs sm:text-sm font-semibold mb-2">Username:</label>
                            <input name="username" class="shadow appearance-none border border-gray-600 rounded-lg w-full py-2 px-3 text-gray-300 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 bg-black bg-opacity-60" required>
                        </div>
                        <div>
                            <label class="block text-gray-300 text-xs sm:text-sm font-semibold mb-2">Password:</label>
                            <input name="password" type="password" class="shadow appearance-none border border-gray-600 rounded-lg w-full py-2 px-3 text-gray-300 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 bg-black bg-opacity-60" required>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg w-full transform transition-transform duration-200 hover:scale-105 focus:outline-none focus:shadow-outline shadow-lg">
                            Log In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
