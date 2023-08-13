<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('round_id') }}
            {{ Form::text('round_id', $position->round_id, ['class' => 'form-control' . ($errors->has('round_id') ? ' is-invalid' : ''), 'placeholder' => 'Round Id']) }}
            {!! $errors->first('round_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $position->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hits') }}
            {{ Form::text('hits', $position->hits, ['class' => 'form-control' . ($errors->has('hits') ? ' is-invalid' : ''), 'placeholder' => 'Hits']) }}
            {!! $errors->first('hits', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra_points') }}
            {{ Form::text('extra_points', $position->extra_points, ['class' => 'form-control' . ($errors->has('extra_points') ? ' is-invalid' : ''), 'placeholder' => 'Extra Points']) }}
            {!! $errors->first('extra_points', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dif_winner_points') }}
            {{ Form::text('dif_winner_points', $position->dif_winner_points, ['class' => 'form-control' . ($errors->has('dif_winner_points') ? ' is-invalid' : ''), 'placeholder' => 'Dif Winner Points']) }}
            {!! $errors->first('dif_winner_points', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dif_total_points') }}
            {{ Form::text('dif_total_points', $position->dif_total_points, ['class' => 'form-control' . ($errors->has('dif_total_points') ? ' is-invalid' : ''), 'placeholder' => 'Dif Total Points']) }}
            {!! $errors->first('dif_total_points', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dif_local_points') }}
            {{ Form::text('dif_local_points', $position->dif_local_points, ['class' => 'form-control' . ($errors->has('dif_local_points') ? ' is-invalid' : ''), 'placeholder' => 'Dif Local Points']) }}
            {!! $errors->first('dif_local_points', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dif_visit_points') }}
            {{ Form::text('dif_visit_points', $position->dif_visit_points, ['class' => 'form-control' . ($errors->has('dif_visit_points') ? ' is-invalid' : ''), 'placeholder' => 'Dif Visit Points']) }}
            {!! $errors->first('dif_visit_points', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dif_victory') }}
            {{ Form::text('dif_victory', $position->dif_victory, ['class' => 'form-control' . ($errors->has('dif_victory') ? ' is-invalid' : ''), 'placeholder' => 'Dif Victory']) }}
            {!! $errors->first('dif_victory', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hit_last_game') }}
            {{ Form::text('hit_last_game', $position->hit_last_game, ['class' => 'form-control' . ($errors->has('hit_last_game') ? ' is-invalid' : ''), 'placeholder' => 'Hit Last Game']) }}
            {!! $errors->first('hit_last_game', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hit_visit') }}
            {{ Form::text('hit_visit', $position->hit_visit, ['class' => 'form-control' . ($errors->has('hit_visit') ? ' is-invalid' : ''), 'placeholder' => 'Hit Visit']) }}
            {!! $errors->first('hit_visit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('hit_local') }}
            {{ Form::text('hit_local', $position->hit_local, ['class' => 'form-control' . ($errors->has('hit_local') ? ' is-invalid' : ''), 'placeholder' => 'Hit Local']) }}
            {!! $errors->first('hit_local', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('position') }}
            {{ Form::text('position', $position->position, ['class' => 'form-control' . ($errors->has('position') ? ' is-invalid' : ''), 'placeholder' => 'Position']) }}
            {!! $errors->first('position', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>