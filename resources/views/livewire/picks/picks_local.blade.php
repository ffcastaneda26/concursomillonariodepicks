   {{-- Datos del Local --}}
   <td class="{{ $acerto ? 'text-2xl font-extrabold' : '' }}">{{ $game->local_points }}</td>
   <td>{{ $game->local_team->alias }}</td>
   <td><img src="{{Storage::url($game->local_team->logo)}}" class="avatar-sm" alt="" width="100px" height="100px"></td>
