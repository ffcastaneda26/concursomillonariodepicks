    {{-- Datos de la visita --}}

    <td><img src="{{Storage::url($game->visit_team->logo)}}" class="avatar-sm" alt="" width="100px" height="100px"></td>
    <td>{{ $game->visit_team->alias }}</td>
        <td class="font-extrabold {{ $acerto && $pick_user->winner == 2 ? 'text-2xl ' : 'text-xl' }}">
        {{ $game->visit_points }}
    </td>
