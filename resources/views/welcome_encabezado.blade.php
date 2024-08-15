<header class="fixed top-0 left-0 w-full bg-white z-10">
    <div class="flex justify-between items-center h-16 px-4">
        <div class="flex items-center">
            <img class="rounded-xs" src="{{ asset('images/logo.jfif') }}" alt="Logo" width="44rem" height="44rem">
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
</header>
<div class="h-16"></div>
