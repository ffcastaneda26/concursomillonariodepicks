<div>
    <tr>
        <td>
             <input wire:model='gamesids.{{ $game->id }}' type="text" value="{{ $game->id }}"/>
        </td>
        {{-- <td>{{ $game->id }}</td> --}}
        <td>{{$game->game_day->format('j-M-y')}} {{$game->game_time->format('h:i A') }}</td>

        {{-- Datos de la visita --}}
        <td>{{ $game->visit_points }}</td>
        <td>{{ $game->visit_team->short }}</td>
        <td>{{ $game->visit_team->name }}</td>

        <td>
            <input type="radio" wire:model="winner" wire:click="mostrar({{ $game->id }},2))" name="winner" value="2" {{ !$game->allow_pick() ? 'disabled' : ''}}/>
        </td>
        <td>BALON</td>
        <td>
            <input type="radio" wire:model="winner" wire:click="mostrar({{ $game->id }},1)" name="winner" value="1" {{ !$game->allow_pick() ? 'disabled' : ''}}/>
        </td>
        {{-- Datos del Local --}}
        <td>{{ $game->local_team->short }}</td>
        <td>{{ $game->local_team->name }}</td>
        <td>{{ $game->local_points }}</td>



        {{-- ¿Acertó o Falló? --}}
        <td>
            <img src="{{ asset('images/afirmativo.png') }}"  width="16px" height="16px">
        </td>
        <td>
            <img src="{{ asset('images/negativo.png') }}"  width="16px" height="16px">

        </td>

        <td align="center">
            @if( $game->allow_pick() )
                <img src="{{ asset('images/afirmativo.png') }}"  width="16px" height="16px">
            @else
                <img src="{{ asset('images/negativo.png') }}"  width="16px" height="16px">
            @endif
        </td>
    </tr>
</div>
