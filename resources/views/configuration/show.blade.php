@extends('adminlte::page')

@section('title', 'Administrador')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Configuration</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('configurations.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Website Name:</strong>
                            {{ $configuration->website_name }}
                        </div>
                        <div class="form-group">
                            <strong>Website Url:</strong>
                            {{ $configuration->website_url }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $configuration->email }}
                        </div>
                        <div class="form-group">
                            <strong>Score Picks:</strong>
                            {{ $configuration->score_picks }}
                        </div>
                        <div class="form-group">
                            <strong>Minutos antes para pronosticar:</strong>
                            {{ $configuration->minuts_before_picks }}
                        </div>
                        <div class="form-group">
                            <strong>¿Permite Empates?</strong>
                            {{ $configuration->allow_tie }}
                        </div>
                        <div class="form-group">
                            <strong>¿Crear pronósticos faltantes?</strong>
                            {{ $configuration->create_mssing_picks }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
