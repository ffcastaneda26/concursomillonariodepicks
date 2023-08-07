@extends('adminlte::page')


@section('title', 'Administrador')


@section('template_title')
    {{ __('Create') }} Juego
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Juego</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('games.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('game.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
