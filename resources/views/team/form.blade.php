<div class="box box-info padding-1">
    <div class="box-body">

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nombre</span>
            {{ Form::text('name', $team->name,
                        ['class' =>  ($errors->has('name') ? ' is-invalid' : ''),
                        'placeholder' => 'Nombre del Equipo',
                        'maxlength' => 50,
                        'size' => 53])}}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Alias</span>
            {{ Form::text('alias', $team->alias,
                        ['class' =>  ($errors->has('alias') ? ' is-invalid' : ''),
                        'placeholder' => 'Alias del Equipo',
                        'maxlength' => 50,
                        'size' => 53])}}
            {!! $errors->first('alias', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Corto</span>
            {{ Form::text('short', $team->short,
                        ['class' =>  ($errors->has('short') ? ' is-invalid' : ''),
                        'placeholder' => 'Corto',
                        'maxlength' => 3,
                        'size' => 2])}}
            {!! $errors->first('short', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            {{ Form::label('logo') }}
            {{ Form::file('logo', $team->logo, ['class' => 'form-control' . ($errors->has('logo') ? ' is-invalid' : ''), 'placeholder' => 'Logo']) }}
            {!! $errors->first('logo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 float-right">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
