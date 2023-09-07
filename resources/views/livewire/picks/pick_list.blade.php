@php
    $allow_pick     = $game->allow_pick();
    $is_last_game   = $game->is_last_game_round();
    $pick_user      = $game->pick_user();
    $print_score    = $game->print_score();
    $acerto         = $game->has_result() && $pick_user && $pick_user->winner == $game->winner;
@endphp
<tr>
    <td>{{$game->game_day->format('j-M-y')}} {{$game->game_time->format('h:i A') }}</td>
    <td>
        <input type="checkbox"
               wire:model='selected.{{  $game->id }}'
               {{ !$allow_pick   ? 'disabled' : ''}}
               {{ $pick_user->selected  ? 'checked' : ''}}
        />
    </td>


    @include('livewire.picks.pick_visit')

    @if( $is_last_game)
        <td><input type='number' wire:model="points_visit_last_game" min=0 max=99 class="{{ $error =='visit' || $error =='tie' ? 'bg-red-500' : ''}}"></td>
        {{-- Icono si acertó/falló o aún no se sabe --}}
        @include('livewire.picks.pick_icono_acerto')
        <td><input type='number' wire:model="points_local_last_game" min=0 max=99 class="{{ $error =='local' || $error =='tie' ? 'bg-red-500' : ''}}"></td>
    @else
        @include('livewire.picks.pick_pick_result')
    @endif

    @include('livewire.picks.picks_local')


</tr>

