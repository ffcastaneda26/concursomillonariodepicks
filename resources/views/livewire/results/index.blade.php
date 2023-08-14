<div class="mt-5">
    @livewire('select-round')
    <div class="container-fluid mt-2">
        @if(isset($message))
            <div class="text-red-600 text-danger text-center text-3xl">
                <h1>{{ $message }}</h1>
            </div>
        @endif


        @if(isset($round_games) && !empty($round_games))
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-xs">
                                    <thead class="thead">
                                        <tr class="bg-dark text-white text-center text-sm">
                                            {{-- <th>Id</th> --}}
                                            <th>Participante</th>
                                            @foreach ($round_games as $game)
                                                <td>{{ $game->visit_team->short }} - {{ $game->local_team->short }}</td>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $participante_anterior = null;
                                            $previous_pick = null;
                                        @endphp

                                        @foreach ($round_picks as $pick)

                                            @if($pick->user_id != $participante_anterior)
                                                 @if(!is_null($previous_pick))
                                                    @if($previous_pick->game->allow_pick())
                                                        <td align="center">
                                                            <img src="{{ asset('images/reloj.jpg') }}" alt="" width="32px" height="32px">
                                                        </td>
                                                    @else
                                                    <td align="center" class="{{  $previous_pick->hit ? 'bg-success' : 'bg-danger' }}">
                                                            <img src="{{ $previous_pick->winner == 1 ? Storage::url($previous_pick->game->local_team->logo) : Storage::url($previous_pick->game->visit_team->logo) }}"
                                                                alt="{{ $previous_pick->winner == 1 ? $previous_pick->game->local_team->short : $previous_pick->game->visit_team->short }}"
                                                                width="45px"
                                                                height="45px">
                                                            <span>
                                                                <img src="{{ $previous_pick->hit  ?   asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                                                            alt="{{ $pick->hit  ?  __('Yes') : 'No' }}"
                                                                            height="12px"
                                                                            width="12px">
                                                            </span>
                                                        </td>
                                                    @endif
                                                @endif
                                                </tr>
                                                <td>{{ $pick->user->name }}</td>
                                            @endif

                                            @if($pick->user_id == $participante_anterior)
                                                    @if($pick->game->allow_pick())
                                                        <td align="center">
                                                            <img src="{{ asset('images/reloj.jpg') }}" alt="" width="32px" height="32px">
                                                        </td>
                                                    @else
                                                    <td align="center" class="{{  $pick->hit ? 'bg-success' : 'bg-danger' }}">
                                                            <img src="{{ $pick->winner == 1 ? Storage::url($pick->game->local_team->logo) : Storage::url($pick->game->visit_team->logo) }}"
                                                                alt="{{ $pick->winner == 1 ? $pick->game->local_team->short : $pick->game->visit_team->short }}"
                                                                width="45px"
                                                                height="45px">
                                                            <span>
                                                                <img src="{{ $pick->hit  ?   asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                                                            alt="{{ $pick->hit  ?  __('Yes') : 'No' }}"
                                                                            height="12px"
                                                                            width="12px">
                                                            </span>
                                                        </td>
                                                    @endif
                                            @endif

                                            @php
                                                $participante_anterior = $pick->user_id;
                                                $previous_pick = $pick;
                                            @endphp
                                        @endforeach
                                        @if(!is_null($previous_pick))
                                            @if($previous_pick->game->allow_pick())
                                                <td align="center">
                                                    <img src="{{ asset('images/reloj.jpg') }}" alt="" width="32px" height="32px">
                                                </td>
                                            @else
                                            <td align="center" class="{{  $previous_pick->hit ? 'bg-success' : 'bg-danger' }}">
                                                    <img src="{{ $previous_pick->winner == 1 ? Storage::url($previous_pick->game->local_team->logo) : Storage::url($previous_pick->game->visit_team->logo) }}"
                                                        alt="{{ $previous_pick->winner == 1 ? $previous_pick->game->local_team->short : $previous_pick->game->visit_team->short }}"
                                                        width="45px"
                                                        height="45px">
                                                    <span>
                                                        <img src="{{ $previous_pick->hit  ?   asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                                                    alt="{{ $pick->hit  ?  __('Yes') : 'No' }}"
                                                                    height="12px"
                                                                    width="12px">
                                                    </span>
                                                </td>
                                            @endif
                                        @endif

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
