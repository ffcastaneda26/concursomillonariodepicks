@extends('adminlte::page')


@section('title', 'Administrador')


@section('template_title')
    {{ $game->name ?? "{{ __('Show') Juego" }}
@endsection


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Juego </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('games.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Jornada:</strong>
                            {{ $game->round_id }}
                        </div>
                        <div class="form-group">
                            <strong>Local:</strong>
                            {{ $game->local_team->name }}
                        </div>
                        <div class="form-group">
                            <strong>Punts Local:</strong>
                            {{ $game->local_points }}
                        </div>
                        <div class="form-group">
                            <strong>Visita:</strong>
                            {{ $game->visit_team->name }}
                        </div>
                        <div class="form-group">
                            <strong>Puntos Visita:</strong>
                            {{ $game->visit_points }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>

                            {{$game->game_day->format('j-F-Y')}} {{$game->game_time->format('h:i A') }}

                        </div>


                        <div class="form-group">
                            <strong>Resultado:</strong>
                            @switch($game->winner)
                                @case(0)
                                    Empate
                                    @break
                                @case(1)
                                    Local
                                    @break
                                @case(2)
                                    Visita
                                    @break
                                @default
                                    Pendiente
                            @endswitch

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
