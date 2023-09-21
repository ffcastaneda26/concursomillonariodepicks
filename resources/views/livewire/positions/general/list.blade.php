<tr>
    <td>{{ $loop->index + 1}}</td>
    <td>{{ $position->name }}</td>
    <td align="center">{{ $position->hits ?  $position->hits : '-'}}</td>
    <td align="center">{{ $position->hit_last_games ? $position->hit_last_games : '-' }}</td>
    <td align="center">{{ $position->error_abs_local_visita ? $position->error_abs_local_visita : '-'}}</td>
</tr>

