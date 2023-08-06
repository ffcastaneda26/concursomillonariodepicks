<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Nombre Sitio</span>
                {{ Form::text('website_name', $configuration->website_name,
                            ['class' => 'form-control' . ($errors->has('website_name') ? ' is-invalid' : ''),
                            'placeholder' => 'Nombre del sitio'])
                            }}
                {!! $errors->first('website_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Url</span>
            {{ Form::text('website_url', $configuration->website_url,
            ['size' => '80',
                'class' =>  ($errors->has('website_url') ? ' is-invalid' : ''), 'placeholder' => 'Url']) }}
            {!! $errors->first('website_url', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Correo</span>
            {{ Form::text('email', $configuration->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Minutos Antes para pronóstico</span>
                <input type="number"
                        name="minuts_before_picks"
                        id="minuts_before_picks"
                        max="30"
                        min="5"
                        size="5"
                        value="{{  $configuration->minuts_before_picks }}"
                        class="{{ $errors->has('minuts_before_picks') ? ' is-invalid' : '' }}"
                >
              </div>
              {!! $errors->first('minuts_before_picks', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- ¿Permite Empates? --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">¿Permite Empate?</span>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <div class="ml-3">
                        <label class="radio-inline">
                            <input type="radio" name="allow_tie" value="1" {{ $configuration->allow_tie ? 'checked' : ''}}/> SI
                        </label>
                    </div>
                    <div class="ml-3">
                        <label class="radio-inline">
                            <input type="radio" name="allow_tie" value="0" {{ !$configuration->allow_tie ? 'checked' : ''}}/> NO
                        </label>
                    </div>
                </div>
        </div>

        {{-- ¿Solicitar Resultaos en Pronóstico? --}}

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">¿Solicitar Puntos en Pronósticos?</span>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <div class="ml-3">
                        <label class="radio-inline">
                            <input type="radio" name="score_picks" value="1" {{ $configuration->score_picks ? 'checked' : ''}}/> SI
                        </label>
                    </div>
                    <div class="ml-3">
                        <label class="radio-inline">
                            <input type="radio" name="score_picks" value="0" {{ !$configuration->score_picks ? 'checked' : ''}}/> NO
                        </label>
                    </div>
                </div>
        </div>


    </div>
    <div class="box-footer mt20 float-right">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
