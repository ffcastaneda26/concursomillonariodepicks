<thead class="thead">
    <tr class="bg-dark text-white text-center text-sm">
        {{-- <th>Id</th> --}}
        <th>Participante</th>
        @foreach ($round_games as $game)
            <td><label  class="{{ $game->winner == 2 ? 'font-bold text-base' : '' }}"> {{ $game->visit_team->short }}</label>
                -
                <label  class="{{ $game->winner == 1 ? 'font-bold text-base' : '' }}"> {{ $game->local_team->short }}</label>
            </td>
        @endforeach
    </tr>
    <tr class="bg-dark text-white text-center text-sm">
        <td></td>
        @foreach ($round_games as $game)
        <td>
            @if($game->visit_points || $game->local_pints)
                {{$game->visit_points ? $game->visit_points : '0' }}
                -
                {{ $game->local_points ? $game->local_points : '0' }}
            @endif
        </td>
    @endforeach
    </tr>
</thead>
