    {{-- Datos de la visita --}}

    <td><img src="{{Storage::url($game->visit_team->logo)}}" class="avatar-sm" alt="" width="100px" height="100px"></td>
    <td>{{ $game->visit_team->alias }}</td>
    <td class="{{ $acerto ? 'text-2xl font-extrabold' : 'font-bold' }}">{{ $game->visit_points }}</td>
