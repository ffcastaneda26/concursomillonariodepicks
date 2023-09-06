    {{-- Datos de la visita --}}
    <td>{{ $game->visit_points }}</td>
    <td><img src="{{Storage::url($game->visit_team->logo)}}" class="avatar-sm" alt="" width="100px" height="100px"></td>
    <td>{{ $game->visit_team->alias }}</td>
