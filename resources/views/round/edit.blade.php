@extends('adminlte::page')


@section('title', 'Administrador')


@section('template_title')
    {{ __('Create') }} Jornada
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Jornada</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rounds.update', $round->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('round.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
