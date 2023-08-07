<div class="box box-info padding-1">
    <div class="box-body">
        {{-- Fecha de Inicio --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">{{ Form::label('start_date') }}</span>
            <input type="date"
                   name="start_date"
                   id="start_date"
                   value="{{ $round->start_date }}"
                   size="10"
                   class="{{ $errors->has('start_date') ? ' is-invalid' : '' }}">
            {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        {{-- Fecha Final --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">{{ Form::label('end_date') }}</span>
            <input type="date"
                   name="end_date"
                   id="end_date"
                   value="{{ $round->end_date }}"
                   size="10"
                   class="{{ $errors->has('end_date') ? ' is-invalid' : '' }}">
            {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- Tipo de Jornada --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">{{ Form::label('Type') }}</span>
            <select name="type" id="type" class="{{ $errors->has('type') ? ' is-invalid' : '' }}">
                <option value="">Seleccione</option>
                <option value="Regular" {{ $round->type =='Regular' ? 'selected' : ''}}>Regular</option>
                <option value="Divisional" {{ $round->type =='Divisional' ? 'selected' : ''}}>Divisional</option>
                <option value="Conferencia" {{ $round->type =='Conferencia' ? 'selected' : ''}}>Conferencia</option>
            </select>
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 float-right">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
