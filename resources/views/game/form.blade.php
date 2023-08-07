<div class="box box-info padding-1">
    <div class="box-body">

        {{-- Jornada --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Jornada</span>
            <select name="round_id" id="round_id" class="{{ $errors->has('round_id') ? ' is-invalid' : '' }}">
                <option value="">Seleccione</option>
                @foreach ($rounds as $round )
                    <option value="{{ $round->id }}" {{ $round->id == $game->round_id ? 'selected' : '' }}>
                        {{ $round->id }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('round_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- Equipo Local --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Local</span>
            <select name="local_team_id" id="local_team_id" class="{{ $errors->has('local_team_id') ? ' is-invalid' : '' }}">
                <option value="">Seleccione</option>
                @foreach ($teams as $team )
                    <option value="{{ $team->id }}" {{ $team->id == $game->local_team_id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('local_team_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        {{-- Puntos Local --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Puntos Local</span>
            <input type="number" name="local_points" id="local_points"  min="0" value="{{ $game->local_points }}">
        </div>


        {{-- Equipo Visita --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Visita</span>
            <select name="visit_team_id" id="visit_team_id" class="{{ $errors->has('visit_team_id') ? ' is-invalid' : '' }}">
                <option value="">Seleccione</option>
                @foreach ($teams as $team )
                    <option value="{{ $team->id }}" {{ $team->id == $game->visit_team_id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('visit_team_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        {{-- Puntos Visita --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Puntos Visita</span>
            <input type="number" name="visit_points" id="visit_points" min="0" value="{{ $game->visit_points }}">
        </div>

        {{-- Fecha corta --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Fecha</span>

            {{ Form::date('game_day', $game->game_day, ['class' => 'form-control' . ($errors->has('game_day') ? ' is-invalid' : ''), 'placeholder' => 'Game Day']) }}
            {!! $errors->first('game_day', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- Hora --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Hora</span>
            {{ Form::time('game_time', $game->game_time, ['class' => 'form-control' . ($errors->has('game_time') ? ' is-invalid' : ''), 'placeholder' => 'Game Time']) }}
            {!! $errors->first('game_time', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Fecha y Hora Completa</span>
            <input type="datetime-local" id="game_date" name="game_date" value="{{ $game->game_date }}">
               {!! $errors->first('game_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- Resultado --}}
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Resultado</span>
            <select name="winner" id="winner" class="{{ $errors->has('winner') ? ' is-invalid' : '' }}">
                <option value="">Seleccione</option>
                <option value="1" {{ $game->winner ==1 ? 'selected' : ''}}>Local</option>
                <option value="2" {{ $game->winner ==2 ? 'selected' : ''}}>Visita</option>
                <option value="0" {{ $game->winner ==0 ? 'selected' : ''}}>Empate</option>
            </select>
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 float-right">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
