<header class="fixed top-0 left-0 w-full bg-white z-10">
    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <div>
                            <div class="container fmx-auto px-4 py-2 justify-between items-center gap-2 sm:gap-8">
                                <ul class="flex  space-x-4 justify-between">
                                    <li><a href="#" class="text-xs sm:text-lg hover:underline hover:bg-blue-500 hover:text-white ">PORTADA</a></li>
                                    <li><a href="#que-es" class="text-xs sm:text-lg hover:underline hover:bg-blue-500 hover:text-white ">¿QUE ES EL CONCURSO?</a></li>
                                    <li><a href="#bases" class="text-xs sm:text-lg hover:underline hover:bg-blue-500 hover:text-white ">BASES</a></li>
                                    <li><a href="#semanas-descanso" class="text-xs sm:text-lg hover:underline hover:bg-blue-500 hover:text-white ">SEMANAS DE DESCANSO</a></li>
                                    <li><a href="#como-participar" class="text-xs sm:text-lg hover:underline hover:bg-blue-500 hover:text-white ">COMO PARTICIPAR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <div class="container mx-auto px-4 py-2 justify-between items-center gap-2 sm:gap-8">
                            <ul class="flex  space-x-4 justify-between">
                                <li>
                                    <a href="{{ route('login') }}"
                                        class="font-semibold text-gray-500 hover:text-gray-700 focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        INGRESAR
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}"
                                            class="font-semibold text-gray-500 hover:text-gray-700 focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                            REGISTRARSE
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <div class="flex flex-col justify-center items-center gap-2">
                    <div class="container mx-auto px-4 py-2 justify-between items-center gap-2 sm:gap-8">
                        <ul class="flex flex-col justify-start">
                            <li>
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-gray-500 hover:text-gray-700 focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    INGRESAR
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}"
                                        class="font-semibold text-gray-500 hover:text-gray-700 focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        REGISTRARSE
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="container mx-auto px-4 py-2 justify-between items-center gap-2">
                    <ul class="flex flex-col justify-start">
                        <li><a href="#" class="hover:underline">PORTADA</a></li>
                        <li><a href="#que-es" class="hover:underline">¿QUE ES EL CONCURSO?</a></li>
                        <li><a href="#bases" class="hover:underline">BASES</a></li>
                        <li><a href="#semanas-descanso" class="hover:underline">SEMANAS DE DESCANSO</a></li>
                        <li><a href="#como-participar" class="hover:underline">COMO PARTICIPAR</a></li>
                    </ul>
                </div>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->




                </div>
            </div>
        </div>
    </nav>
</header>
