<tr class="text-base">
    <td>{{ $position->position }}</td>
    <td class="text-left">{{ $position->user->name }}</td>
    <td align="center">{{ $position->hits }}</td>
    @if($tie_breaker_game_played)
        @php
            $pick_game = $position->user->picks_game($last_game_round->id)->first();
            $visit_points =  $pick_game->visit_points;
            $local_points =  $pick_game->local_points;
        @endphp
        <td align="center">
            <img src="{{ $position->hit_last_game  ? asset('images/afirmativo.png')
                                                   : asset('images/negativo.png') }}"
            alt="X" width="17" height="17">
            <span>{{$visit_points }} -  {{$local_points }}<span></span>
        </td>
        <td align="center">{{ $position->error_abs_local_visita }}</td>
        <td align="center">{{ $position->dif_winner_points }}</td>
        <td align="center">{{ $position->marcador_total }}</td>
    @endif
</tr>

