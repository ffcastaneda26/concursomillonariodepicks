<tr>
    <td>{{ $game->game_day->format('j-M-y')}} {{$game->game_time->format('h:i A') }}</td>

    <td align="center">
        <label for="">
                {{ $game->handicap != 0 ? number_format($game->handicap*-1, 1, '.', ',') : '-' }}
        </label>
    </td>
    <td>
        @if ($game->visit_team->logo)
            <img src="{{Storage::url($game->visit_team->logo)}}" class="avatar-sm" alt="" width="100px" height="100px">
        @endif
    </td>

    <td>{{ $game->visit_team->alias }}</td>
    <td align="center"><input type="text" value="{{ $game->visit_points }}" disabled size="3"></td>


    <td align="center"><input type="text" value="{{ $game->local_points }}" disabled size="3"></td>
    <td>
        @if ($game->local_team->logo)
            <img src="{{Storage::url($game->local_team->logo)}}" class="avatar-sm" alt="" width="100px" height="100px">
        @endif
    </td>
    <td>{{ $game->local_team->alias }}</td>
    <td align="center">
        <label for="">
                {{ $game->handicap != 0 ? number_format($game->handicap, 1, '.', ',') : '-' }}
        </label>
    </td>
    @role('Admin')
        <td  class="px-1 text-center">
            {{-- TODO:: ¿Se le puede/debe bloquear al administrador? --}}
            <button
                wire:click="edit({{ $game->id }})"
                class="btn btn-success waves-effect waves-light"
                title="{{__("Edit")}}">
                <i class="mdi mdi-eye-circle"></i>
            </button>
        </td>
    @endrole

</tr>
