<div class="container">

    <div class="card">
        <div class="card-title">
                <h1>  {{ $game->visit_team->name }} Vs  {{ $game->local_team->name }}   {{ $game->game_day->format('j-F-y')}} {{$game->game_time->format('h:i A') }} </h1>
        </div>



        <div class="row align-items-start mt-2">
            @if($error_message)
                <div class="badge rounded-pill bg-danger">
                    {{ $error_message }}
                </div>
            @endif

            <div class="row">
                <x-validation-errors></x-validation-errors>
            </div>
            <div class="col-md-4 flex flex-col">
                <label class="input-group-text mb-2">PTOS LOCAL</label>
                <label class="input-group-text mb-2">PTOS VISITA</label>
                <label class="input-group-text mb-2">LÍNEA</label>
            </div>

            <div class="col flex flex-col">
                {{-- Puntos Local --}}
                <div class="col-md-4">
                <input type="number"
                        wire:model="main_record.local_points"
                        required
                        class="form-control  mb-2 @error('main_record.local_points') is-invalid @enderror"
                        min="0" max="999"
                >
                @error('main_record.local_points')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                </div>

                <div class="col-md-4">
                <input type="number"
                        wire:model="main_record.visit_points"
                        required
                        class="form-control  mb-2 @error('main_record.visit_points') is-invalid @enderror"
                        min="0" max="999"
                >
                @error('main_record.visit_points')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                </div>

                <div class="col-md-4">
                <input type='number'
                        wire:model="main_record.handicap"
                        step='0.5'
                        value='0.00'
                        placeholder='0.00'
                        class="form-control  mb-2 @error('main_record.handicap') is-invalid @enderror"/>
                @error('main_record.visit_points')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                </div>
        </div>

        </div>
    </div>

</div>
