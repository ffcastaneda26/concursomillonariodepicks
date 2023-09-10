<tr class="text-base">

    <td>{{$game->game_day->format('j-M-y')}} {{$game->hour }}</td>

    <td align="center">
        <label for="">
                {{ $game->handicap != 0 ? number_format($game->handicap*-1, 1, '.', ',') : '-' }}
        </label>
    </td>
    <td>
        @if ($game->visit_team->logo)
            <img src="{{Storage::url($game->visit_team->logo)}}" class="avatar-sm" alt="">

        @endif
    </td>

    <td>{{ $game->visit_team->alias }}</td>
    <td align="center">
        <label class="{{ $game->winner == 2 ? 'text-xl font-extrabold' : '' }}">
            @if($game->has_result())
                {{ $game->visit_points ? $game->visit_points : '0'}}
            @endif
        </label>
    </td>

    <td align="center">
        <label class="{{ $game->winner == 1 ? 'text-2xl font-extrabold' : ''}}">
            @if($game->has_result())
                {{ $game->local_points ? $game->local_points : '0'}}
            @endif
        </label>

    </td>
    <td>
        @if ($game->local_team->logo)
            <img src="{{Storage::url($game->local_team->logo)}}" class="avatar-sm" alt="">
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
