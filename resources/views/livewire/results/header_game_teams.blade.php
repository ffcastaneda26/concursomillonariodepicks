<thead class="thead">
    <tr class="bg-dark text-white text-center text-sm">
        <th rowspan="2" valign="middle">PARTICIPANTE</th>
        @foreach ($round_games as $game)
            <td class="text-left">
                <img src="{{ Storage::url($game->visit_team->logo) }}" class="avatar-xs">
                <br>
                <img src="{{ Storage::url($game->local_team->logo) }}" class="avatar-xs">
            </td>
        @endforeach
        <th valign="middle" colspan="2"></th>
    </tr>
    <tr class="bg-dark text-white text-center text-sm">
        @foreach ($round_games as $game)
            <td>
                @if (!is_null($game->visit_points) && is_null($game->local_pints))
                    {{ $game->visit_points ? $game->visit_points : '0' }}
                    -
                    {{ $game->local_points ? $game->local_points : '0' }}
                @endif
            </td>
        @endforeach
        <th>MNF</th>
        <th valign="middle">ACIERTOS</th>
    </tr>
</thead>

