<div class="flex justify-between h-16">
    <div class="sm:fixed sm:top-0 sm:left-0 p-6 text-right z-10">
        <img class="rounded-xs" src="{{ asset('images/logo.jfif') }}" width="64px" height="64px">
    </div>

    <div class="fixed top-0 right-0 p-6 text-right">

        @auth
            <a href="{{ url('/dashboard') }}"
                class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Dashboard
            </a>
        @else
            <div class="flex flex-row grow">
                <a href="{{ route('login') }}"
                    class="ml-4 font-semibold text-white hover:bg-white hover:text-black dark:bg-black dark:hover:text-white focus:p-20 focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        INGRESAR
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 mr-20 font-semibold text-white hover:bg-white hover:text-black dark:bg-black dark:hover:text-white focus:p-20 focus:outline-2 focus:rounded-sm focus:outline-red-500">REGISTRARSE</a>
                    <div class="w-10">&nbsp;</div>
                @endif
            </div>
        @endauth
    </div>
</div>
