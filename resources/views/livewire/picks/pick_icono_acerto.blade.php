    {{-- Icono si acertó/falló o aún no se sabe --}}
    <td>
        {{ $acerto }}
        @if($pick_user && $print_score)
            @if($acerto)
                <img src="{{ asset('images/afirmativo.jpg') }}" alt="X" width="17" height="17">
            @else
                <img src="{{ asset('images/negativo.jpg') }}" alt="X" width="17" height="17">
            @endif
        @else
            <img src="{{ asset('images/balon.jpg') }}" alt="X" width="17" height="17">
        @endif
    </td>
