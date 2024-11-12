<!-- header.blade.php -->
<header class="bg-gradient-to-r from-indigo-500 to-violet-300 text-white p-4 print-hidden shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold flex items-center">
            <a href="/welcome" class="flex items-center">
                <img src="{{ asset('images/LOGO.png') }}" alt="Sakshi Enterprises Logo" class="h-10 mr-2" />
            </a>
        </h1>
        <p class="text-right hidden md:block">Providing Quality Services Since 2024</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button 
                type="submit" 
                class="bg-blue-400 text-white py-1 px-3 rounded hover:bg-blue-600 ml-4">
                Logout
            </button>
        </form>
    </div>
</header>
