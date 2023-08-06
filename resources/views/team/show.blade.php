@extends('adminlte::page')

@section('title', 'Administrador')

@section('template_title')
    {{ $team->name ?? "{{ __('Show') Equipo" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Team</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('teams.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $team->name }}
                        </div>
                        <div class="form-group">
                            <strong>Alias:</strong>
                            {{ $team->alias }}
                        </div>
                        <div class="form-group">
                            <strong>Short:</strong>
                            {{ $team->short }}
                        </div>
                        <div class="form-group">
                            <strong>Logo:</strong>
                            {{ $team->logo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
