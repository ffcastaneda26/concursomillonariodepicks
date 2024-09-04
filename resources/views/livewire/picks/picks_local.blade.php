   {{-- Datos del Local --}}
   <td class="font-extrabold {{ $acerto && $pick_user->winner == 1 ? 'text-2xl ' : 'text-xl' }}">
        {{ $game->local_points }}
    </td>
   {{-- <td>{{ $game->local_team->alias }}</td> --}}
   <td><img src="{{Storage::url($game->local_team->logo)}}" class="avatar-xs"></td>
