<header class="fixed top-0 left-0 w-full bg-white z-30 shadow-md">
    <div class="flex justify-between items-center h-20 sm:h-16 px-4">
        <!-- Logo -->
        <div class="flex items-center">
            <img class="rounded-xs" src="{{ asset('images/logo.jfif') }}" alt="Logo" width="44" height="44">
        </div>

        <!-- Menú de desktop -->
        <div class="hidden sm:flex container mx-auto px-4 py-2 flex-col sm:flex-row justify-between items-center gap-2 sm:gap-8">
            <ul class="flex flex-col sm:flex-row space-x-4 justify-between">
                <li><a href="#" class="font-bold text-lg">PORTADA</a></li>
                <li><a href="#que-es" class="hover:underline">¿QUÉ ES EL CONCURSO?</a></li>
                <li><a href="#bases" class="hover:underline">BASES</a></li>
                <li><a href="#semanas-descanso" class="hover:underline">SEMANAS DE DESCANSO</a></li>
                <li><a href="#como-participar" class="hover:underline">CÓMO PARTICIPAR</a></li>
            </ul>
        </div>

        <!-- Autenticación -->
        <div class="flex items-center">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="font-semibold text-gray-500 hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Dashboard
                </a>
            @else
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-500 hover:text-gray-700 focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        INGRESAR
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="font-semibold text-gray-500 hover:text-gray-700 focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            REGISTRARSE
                        </a>
                    @endif
                </div>
            @endauth
        </div>

        <!-- Menú hamburguesa en móvil -->
        <div x-data="{ open: false }">
            <div class="sm:hidden flex items-center justify-start px-4 py-2">
                <button @click="open = !open" class="text-gray-800 focus:outline-none">
                    <!-- Ícono del menú hamburguesa -->
                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Menú desplegable en móvil -->
            <div x-show="open" @click.away="open = false" x-transition:enter="transition-transform ease-out duration-300" x-transition:enter-start="transform -translate-y-full" x-transition:enter-end="transform translate-y-0" x-transition:leave="transition-transform ease-in duration-300" x-transition:leave-start="transform translate-y-0" x-transition:leave-end="transform -translate-y-full" class="fixed top-16 left-0 w-full bg-white shadow-lg z-20">
                <div class="pt-2 pb-3 space-y-1">
                    <div class="container mx-auto px-4 py-2">
                        <nav class="flex flex-col space-y-4">
                            <!-- Botón de cerrar -->
                            <button @click="open = false" class="text-gray-800 focus:outline-none mb-4">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <ul class="flex flex-col space-y-4">
                                <li><a href="#" class="font-bold text-lg">PORTADA</a></li>
                                <li><a href="#que-es" class="hover:underline">¿QUÉ ES EL CONCURSO?</a></li>
                                <li><a href="#bases" class="hover:underline">BASES</a></li>
                                <li><a href="#semanas-descanso" class="hover:underline">SEMANAS DE DESCANSO</a></li>
                                <li><a href="#como-participar" class="hover:underline">CÓMO PARTICIPAR</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
