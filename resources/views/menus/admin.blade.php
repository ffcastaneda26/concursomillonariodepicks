@role('Admin')
    <div class="mt-3 relative">
        <x-dropdown align="right" width="30">
            <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                        CONFIGURACION
                    </button>
                </span>
            </x-slot>

            <x-slot name="content">
                <div class="w-30">
                    <!-- Configuración General -->
                    @if(env('SHOW_CONFIGURATION_MENU',false))
                        <x-dropdown-link href="{{ route('configurations') }}">
                            Configuración
                        </x-dropdown-link>
                    @endif

                    <!-- Usuarios -->
                    @if(env('SHOW_USERS_MENU',false))
                        <x-dropdown-link href="{{ route('users') }}">
                            Usuarios
                        </x-dropdown-link>
                    @endif

                    @if(env('SHOW_ROUNDS_MENU',false))
                        <x-dropdown-link href="{{ route('rounds') }}">
                            Jornadas
                        </x-dropdown-link>
                    @endif

                    <x-dropdown-link href="{{ route('teams') }}">
                        Equipos
                    </x-dropdown-link>

                    <x-dropdown-link href="{{ route('games') }}">
                        Partidos
                    </x-nav-link>

                </div>
            </x-slot>
        </x-dropdown>
    </div>

    @if(env('ALLOW_EDIT_PICKS_TO_ADMIN',false))
        <x-nav-link href="{{ route('admin-picks') }}" :active="request()->routeIs('admin-picks')">
            Pronósticos
        </x-nav-link>
    @endif

    @if (Route::has('positions-by-round'))
        <x-nav-link href="{{ route('positions-by-round') }}" :active="request()->routeIs('positions-by-round')">
            Posiciones por Jornada
        </x-nav-link>
    @endif

    @if (Route::has('general-positions'))
        <x-nav-link href="{{ route('general-positions') }}" :active="request()->routeIs('general-positions')">
            Posiciones Generales
        </x-nav-link>
    @endif

    @if(env('SHOW_QUALIFY_PICKS_MENU',false))
        <x-nav-link href="{{ route('qualify-picks') }}" :active="request()->routeIs('qualify-picks')">
            Califica Pronósticos
        </x-nav-link>
    @endif


@endrole
