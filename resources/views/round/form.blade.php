<div class="box box-info padding-1">
    <div class="box-body">
        {{-- Fecha de Inicio --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">{{ Form::label('fecha_inicio') }}</span>
            <input type="date"
                   name="fecha_inicio"
                   id="fecha_inicio"
                   value="{{ $round->fecha_inicio }}"
                   size="10"
                   class="{{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}">
            {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        {{-- Fecha Final --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">{{ Form::label('fecha_final') }}</span>
            <input type="date"
                   name="fecha_final"
                   id="fecha_final"
                   value="{{ $round->fecha_final }}"
                   size="10"
                   class="{{ $errors->has('fecha_final') ? ' is-invalid' : '' }}">
            {!! $errors->first('fecha_final', '<div class="invalid-feedback">:message</div>') !!}
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
