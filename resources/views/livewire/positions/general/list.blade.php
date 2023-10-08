<tr>
    <td  align="center">{{ $position->position }}</td>
    <td>{{ $position->user->name }}</td>
    <td align="center">{{ $position->hits ?  $position->hits : '-'}}</td>
    {{-- <td align="center">{{ $position->hits_breaker ?  $position->hits_breaker : '-'}}</td> --}}
    {{-- <td align="center">{{ $position->total_error ? $position->total_error : '-'}}</td> --}}
</tr>

