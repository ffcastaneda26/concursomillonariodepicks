@extends('layouts.app')

@section('template_title')
    {{ $position->name ?? "{{ __('Show') Position" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Position</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('positions.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Round Id:</strong>
                            {{ $position->round_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $position->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Hits:</strong>
                            {{ $position->hits }}
                        </div>
                        <div class="form-group">
                            <strong>Extra Points:</strong>
                            {{ $position->extra_points }}
                        </div>
                        <div class="form-group">
                            <strong>Dif Winner Points:</strong>
                            {{ $position->dif_winner_points }}
                        </div>
                        <div class="form-group">
                            <strong>Dif Total Points:</strong>
                            {{ $position->dif_total_points }}
                        </div>
                        <div class="form-group">
                            <strong>Dif Local Points:</strong>
                            {{ $position->dif_local_points }}
                        </div>
                        <div class="form-group">
                            <strong>Dif Visit Points:</strong>
                            {{ $position->dif_visit_points }}
                        </div>
                        <div class="form-group">
                            <strong>Dif Victory:</strong>
                            {{ $position->dif_victory }}
                        </div>
                        <div class="form-group">
                            <strong>Hit Last Game:</strong>
                            {{ $position->hit_last_game }}
                        </div>
                        <div class="form-group">
                            <strong>Hit Visit:</strong>
                            {{ $position->hit_visit }}
                        </div>
                        <div class="form-group">
                            <strong>Hit Local:</strong>
                            {{ $position->hit_local }}
                        </div>
                        <div class="form-group">
                            <strong>Position:</strong>
                            {{ $position->position }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
