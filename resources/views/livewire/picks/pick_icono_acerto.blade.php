    {{-- Icono si acertó/falló o aún no se sabe --}}
    <td>

        @if($pick_user && $game->has_result())

            @if($acerto)
                <img src="{{ asset('images/afirmativo.png') }}" alt="X" width="17" height="17">
             @else
                <img src="{{ asset('images/negativo.png') }}" alt="NO" width="17" height="17">
            @endif
        @else
            <img src="{{ asset('images/balon.jpg') }}" alt="X" width="17" height="17">
        @endif
    </td>

