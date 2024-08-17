<header class="fixed top-0 left-0 w-full bg-white z-10">
    <div class="flex justify-between items-center h-32 sm:h-16 px-4">
        <div class="flex items-center">
            <img class="rounded-xs" src="{{ asset('images/logo.jfif') }}" alt="Logo" width="44rem" height="44rem">
        </div>

        <div>
            <div class="container mx-auto px-4 py-2 flex-col sm:flex-row justify-between items-center gap-2 sm:gap-8">
                <ul class="flex flex-col sm:flex-row space-x-4 justify-between">
                    <li><a href="#" class="font-bold text-lg">PORTADA</a></li>
                    <li><a href="#que-es" class="hover:underline">¿QUE ES EL CONCURSO?</a></li>
                    <li><a href="#bases" class="hover:underline">BASES</a></li>
                    <li><a href="#semanas-descanso" class="hover:underline">SEMANAS DE DESCANSO</a></li>
                    <li><a href="#como-participar" class="hover:underline">COMO PARTICIPAR</a></li>
                </ul>
            </div>
        </div>


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
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <div class="container mx-auto px-4 py-2 flex-col sm:flex-row justify-between items-center gap-2 sm:gap-8">
                <ul class="flex space-x-4 justify-between">
                    <li><a href="#" class="font-bold text-lg">PORTADA</a></li>
                    <li><a href="#que-es" class="hover:underline">¿QUE ES EL CONCURSO?</a></li>
                    <li><a href="#bases" class="hover:underline">BASES</a></li>
                    <li><a href="#semanas-descanso" class="hover:underline">SEMANAS DE DESCANSO</a></li>
                    <li><a href="#como-participar" class="hover:underline">COMO PARTICIPAR</a></li>
                </ul>
            </div>
        </div>
    </div>


</header>
