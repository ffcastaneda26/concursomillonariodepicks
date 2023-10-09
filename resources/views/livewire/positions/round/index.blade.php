<div>
    @livewire('select-round', ['show_all'=> false])
    @if(isset($records ))
        <div class="flex  justify-center justify-items-center">
            <div class="{{ $tie_breaker_game_played ? 'col-sm-12' : 'col-4'}}">
                <div class="card">
                    <div class="card-body">
                            <table class="table table-striped table-responsive table-hover text-xs">
                                @if(isset($my_position) && $tie_breaker_game_played )
                                    <tr>                                    <tr>
                                        <td colspan="7" class="text-base text-center">USTED OCUPA LA POSICION: {{ $my_position->position }}</td>
                                    </tr>
                                    <tr class="text-base" style="background-color:#9BFDC7;">
                                        <td>{{$my_position->position }}</td>
                                        <td>{{$my_position->user->name }}</td>
                                        <td align="center">{{$my_position->hits }}</td>
                                        @if($tie_breaker_game_played)
                                            <td align="center">
                                                <img src="{{$my_position->hit_last_game  ? asset('images/afirmativo.png')
                                                                                    : asset('images/negativo.png') }}"
                                                alt="X" width="17" height="17">
                                            </td>
                                            <td align="center">{{$my_position->error_abs_local_visita }}</td>
                                            <td align="center">{{$my_position->dif_winner_points }}</td>
                                            <td align="center">{{$my_position->marcador_total }}</td>
                                        @endif
                                    </tr>
                                @endif

                                @include('livewire.positions.round.table')


                                <tbody>
                                    @foreach ($records as $position)
                                        @include('livewire.positions.round.list')
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $records->links()}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
