<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('head', 'Administrador')</title>
    <!-- Incluir Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <img class="mx-auto h-10 w-auto" src="https://blade-ui-kit.com/images/livewire.svg" alt="Livewire Logo">
            <span class="text-lg font-semibold">Nombre de la Aplicación</span>
        </div>
        <!-- Dropdown -->
        <div class="relative" x-data="{ 
            open: false,
        }">
            <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none">
                <span class="font-semibold">{{ auth()->user()->name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a.75.75 0 0 0-.53.22l-7.25 7a.75.75 0 1 0 1.06 1.06L10 5.81l6.72 6.97a.75.75 0 0 0 1.06-1.06l-7.25-7A.75.75 0 0 0 10 3z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" x-init="() => { $el.classList.remove('hidden'); }" class="hidden animate__animated animate__fadeIn animate__faster absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1">
                <a href="{{ route('admin.logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</a>
            </div>
        </div>

    </nav>

    <!-- Content -->
    <div class="flex flex-1">
        <!-- Admin Menu -->
        <div class="bg-gray-200 p-4 w-1/6">
            <!-- Aquí colocarás el contenido del menú del admin -->
            <p class="text-gray-700">Menú de Administrador</p>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-4">
            <!-- Aquí colocarás el contenido principal de tu aplicación -->
            {{ $slot }}
        </div>
    </div>
</body>
</html>
