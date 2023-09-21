@php
    $allow_pick     = true;
    $is_last_game   = $game->is_last_game_round();
    $pick_user      = $game->pick_user($user->id);
    $print_score    = $game->print_score();
    $acerto         = $game->has_result() && $pick_user && $pick_user->winner == $game->winner;

@endphp
<tr>
    <td>{{$game->game_day->format('j-M-y')}} {{$game->hour }}</td>
        <td>
        @if(!$allow_pick && !$pick_user->selected)
            <span class="badge rounded-pill bg-gray-500">X</span>
        @else
            <input type="checkbox"
                wire:model='selected.{{  $game->id }}'
                {{ !$allow_pick                                  ? 'disabled' : ''}}
                class="{{isset($pick_user) && $pick_user->selected && !$allow_pick ? 'bg-gray-500' : ''}}"
                {{ isset($pick_user) && $pick_user->selected     ? 'checked' : ''}}
            />

        @endif
        @if(!$allow_pick)
            <span class="badge rounded-pill bg-gray-500">NO EDITABLE</span>
        @endif

    </td>


    <td class="text-xl {{ $game->handicap*-1 < 0 ? 'text-danger' : '' }}">{{ $game->handicap*-1 != 0 ? number_format($game->handicap*-1, 1, '.', ',') : ''  }}</td>

    @include('livewire.admin_picks.pick_visit')

    @if( $is_last_game)
        <td><input type='number' wire:model="points_visit_last_game" min=0 max=99 class="{{ $error =='visit' || $error =='tie' ? 'bg-red-500' : ''}}"></td>
        {{-- Icono si acertó/falló o aún no se sabe --}}
        @include('livewire.admin_picks.pick_icono_acerto')
        <td><input type='number' wire:model="points_local_last_game" min=0 max=99 class="{{ $error =='local' || $error =='tie' ? 'bg-red-500' : ''}}"></td>
    @else
        @include('livewire.admin_picks.pick_pick_result')
    @endif
    @include('livewire.admin_picks.picks_local')
    <td class="text-xl {{ $game->handicap < 0 ? 'text-danger' : '' }}" >{{ $game->handicap != 0 ? number_format($game->handicap, 1, '.', ',') : ''  }}</td>


</tr>

