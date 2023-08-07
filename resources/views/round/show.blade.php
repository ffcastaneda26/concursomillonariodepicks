@extends('adminlte::page')


@section('title', 'Administrador')


@section('template_title')
    {{ __('Create') }} Jornada
@endsection

@section('template_title')
    {{ $round->name ?? "{{ __('Show') Jornada" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Round</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rounds.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Fecha Inicio:</strong>
                            {{ $round->start_date }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Final:</strong>
                            {{ $round->end_date }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $round->type }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
