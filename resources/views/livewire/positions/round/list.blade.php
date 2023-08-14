<tr>
    <td>{{ $position->position }}</td>
    <td>{{ $position->user->name }}</td>
    <td align="center">{{ $position->hits }}</td>

    <td align="center"><img src="{{ $position->hit_last_game  ? asset('images/afirmativo.png') : asset('images/negativo.png') }}"
        alt="X" width="17" height="17">
    </td>

    <td align="center">{{ $position->dif_total_points }}</td>
    <td align="center">{{ $position->best_shot }}</td>
    <td align="center">{{ $position->dif_winner_points }}</td>
    <td align="center">{{ $position->dif_victory }}</td>
</tr>

