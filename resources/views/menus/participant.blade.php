@auth
        @role('participante')
                @if (Route::has('games'))
                    <x-nav-link href="{{ route('games') }}" :active="request()->routeIs('games')">
                        Partidos
                    </x-nav-link>
                @endif

                @if (Route::has('picks'))
                    <x-nav-link href="{{ route('picks') }}" :active="request()->routeIs('picks')">
                        Pronósticos
                    </x-nav-link>
                @endif

                @if (Route::has('results-by-round'))
                    <x-nav-link href="{{ route('results-by-round') }}" :active="request()->routeIs('results-by-round')">
                        Tabla de Pronósticos
                    </x-nav-link>
                @endif

                @if (Route::has('positions-by-round'))
                    <x-nav-link href="{{ route('positions-by-round') }}" :active="request()->routeIs('positions-by-round')">
                        Posiciones por Jornada
                    </x-nav-link>
                @endif

                @if (Route::has('positions-general'))
                    <x-nav-link href="{{ route('positions-general') }}" :active="request()->routeIs('positions-general')">
                        Posiciones Generales
                    </x-nav-link>
                @endif

                @if (Route::has('picks-review'))
                    <x-nav-link href="{{ route('picks-review') }}" :active="request()->routeIs('picks-review')">
                        Resultados por Jornada
                    </x-nav-link>
                @endif
        @endrole
@endauth
