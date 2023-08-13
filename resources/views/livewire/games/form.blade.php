<div class="container">

    <div class="card">
        <div class="card-title">
                <h1>  {{ $game->visit_team->name }} Vs  {{ $game->local_team->name }}   {{ $game->game_day->format('j-F-y')}} {{$game->game_time->format('h:i A') }} </h1>
            </div>
    </div>
    <div class="row align-items-start">
        @if($error_message)
            <div class="badge rounded-pill bg-danger">
                {{ $error_message }}
            </div>
        @endif

        <div class="row">
            <x-validation-errors></x-validation-errors>
        </div>

        <div class="col flex flex-col mt-2">
            {{-- Puntos Visita --}}
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Puntos Visita</span>
                <input type="number"
                        wire:model="main_record.visit_points"
                        required
                        class="form-control  mb-2 @error('main_record.visit_points') is-invalid @enderror"
                        min="0" max="999"
                        >

            </div>
            @error('main_record.visit_points')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror
            {{-- Puntos Local --}}
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Puntos Local</span>
                <input type="number"
                        wire:model="main_record.local_points"
                        required
                        class="form-control  mb-2 @error('main_record.local_points') is-invalid @enderror"
                        min="0" max="999"
                        >

            </div>
            @error('main_record.local_points')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
