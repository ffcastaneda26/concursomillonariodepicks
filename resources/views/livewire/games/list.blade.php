<tr>
    <td>{{ $game->game_day->format('j-M-y')}} {{$game->game_time->format('h:i A') }}</td>

    <td>{{ $game->visit_team->short }}</td>
    <td>{{ $game->visit_team->name }}</td>
    <td align="center"><input type="text" value="{{ $game->visit_points }}" disabled size="3"></td>
    <td align="center"><input type="text" value="{{ $game->local_points }}" disabled size="3"></td>
    <td>{{ $game->local_team->short }}</td>
    <td>{{ $game->local_team->name }}</td>
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
