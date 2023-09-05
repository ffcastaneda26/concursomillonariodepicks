@role('Admin')
    <x-nav-link href="{{ route('configurations') }}" :active="request()->routeIs('configurations')">
        Configuración
    </x-nav-link>

    {{-- <x-nav-link href="{{ route('entidades') }}" :active="request()->routeIs('entidades')">
        Entidades
    </x-nav-link>
    <x-nav-link href="{{ route('municipios') }}" :active="request()->routeIs('municipios')">
        Municipios
    </x-nav-link> --}}

    <x-nav-link href="{{ route('teams') }}" :active="request()->routeIs('teams')">
    Equipos
    </x-nav-link>

    <x-nav-link href="{{ route('rounds') }}" :active="request()->routeIs('rounds')">
        Jornadas
    </x-nav-link>

    <x-nav-link href="{{ route('games') }}" :active="request()->routeIs('games')">
        Partidos
    </x-nav-link>

@endrole
