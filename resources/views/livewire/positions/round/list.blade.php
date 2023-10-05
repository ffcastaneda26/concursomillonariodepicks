<tr class="text-base">
    <td>{{ $position->position }}</td>
    <td>{{ $position->user->name }}</td>
    <td align="center">{{ $position->hits }}</td>
    @if($tie_breaker_game_played)
        <td align="center">

            <img src="{{ $position->hit_last_game  ? asset('images/afirmativo.png')
                                                : asset('images/negativo.png') }}"
            alt="X" width="17" height="17">
        </td>
        <td align="center">{{ $position->error_abs_local_visita }}</td>
        <td align="center">{{ $position->dif_winner_points }}</td>
        <td align="center">{{ $position->marcador_total }}</td>
    @endif
</tr>

