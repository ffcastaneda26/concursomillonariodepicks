@role('Admin')
    @if(env('SHOW_USERS_MENU',false))
        <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
            Usuarios
        </x-nav-link>
    @endif

    @if(env('SHOW_CONFIGURATION_MENU',false))
        <x-nav-link href="{{ route('configurations') }}" :active="request()->routeIs('configurations')">
            Configuración
        </x-nav-link>
    @endif

    @if(env('SHOW_ROUNDS_MENU',false))
        <x-nav-link href="{{ route('rounds') }}" :active="request()->routeIs('rounds')">
            Jornadas
        </x-nav-link>
    @endif

    <x-nav-link href="{{ route('teams') }}" :active="request()->routeIs('teams')">
        Equipos
    </x-nav-link>

    <x-nav-link href="{{ route('games') }}" :active="request()->routeIs('games')">
        Partidos
    </x-nav-link>

    @if(env('ALLOW_EDIT_PICKS_TO_ADMIN',false))
        <x-nav-link href="{{ route('admin-picks') }}" :active="request()->routeIs('admin-picks')">
            Pronósticos
        </x-nav-link>
    @endif

@endrole
