{{-- <thead class="thead"> --}}
    <tr class="bg-dark text-white text-center">
        <th>Pos</th>
        <th>Participante  </th>
        <th>Aciertos</th>
        @if($tie_breaker_game_played)
            <th>
                    ¿Partido Desempate?
                    <br>
                    {{ $last_game_visit_points }}
                    -
                    {{ $last_game_local_points }}

            </th>
            <th>Error Local + Error Visita</th>
            <th>Error Puntos Ganador</th>
            <th>Marcador Total</th>
        @endif
    </tr>
{{-- </thead> --}}
