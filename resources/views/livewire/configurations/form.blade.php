    <div class="container">
        {{-- <x-jet-validation-errors></x-jet-validation-errors> --}}
        <x-validation-errors></x-validation-errors>
        <div class="row align-items-start">

            <div class="col flex flex-col mt-2">
                {{-- Nombre del Sitio --}}
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nombre Sitio</span>
                    <input type="text"
                            wire:model="main_record.website_name"
                            required
                            placeholder="Nombre"
                            class="form-control mb-2"
                            size="30"
                            maxlength="150">
                </div>

                {{-- Url --}}
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Url</span>
                    <input type="text"
                            wire:model="main_record.website_url"
                            required
                            placeholder="Url"
                            class="form-control mb-2"
                            size="30"
                            maxlength="150">
                </div>


                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Correo</span>
                    <input type="text"
                            wire:model="main_record.email"
                            required
                            placeholder="Url"
                            class="form-control mb-2 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                            size="30"
                            maxlength="100">
                </div>


                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Minutos Para Pronosticar</span>
                    <input type="number"
                            wire:model="main_record.minuts_before_picks"
                            required
                            class="mb-2 {{ $errors->has('minuts_before_picks') ? ' is-invalid' : '' }}"
                            size="3"
                            maxlength="4">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">¿Pedir Resultados?</span>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" wire:model="score_picks" class="btn-check" name="score_picks" id="score_picks_yes" value="1">
                            <label class="mr-2 btn btn-outline-success" for="score_picks_yes">
                                <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                            </label>

                            <input type="radio" wire:model="score_picks" class="btn-check ml-4" name="score_picks" id="score_picks_no" value="0">
                            <label class="ml-5 btn btn-outline-danger" for="score_picks_no">
                                <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                            </label>
                        </div>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">¿Permite Empates??</span>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" wire:model="allow_tie" class="btn-check" name="allow_tie" id="allow_tie_yes" value="1">
                            <label class="mr-2 btn btn-outline-success" for="allow_tie_yes">
                                <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                            </label>

                            <input type="radio" wire:model="allow_tie" class="btn-check ml-4" name="allow_tie" id="allow_tie_no" value="0">
                            <label class="ml-5 btn btn-outline-danger" for="allow_tie_no">
                                <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                            </label>
                        </div>
                </div>


                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">¿Crear Pronósticos Faltantes?</span>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" wire:model="create_mssing_picks" class="btn-check" name="create_mssing_picks" id="create_mssing_picks_yes" value="1">
                            <label class="mr-2 btn btn-outline-success" for="create_mssing_picks_yes">
                                <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                            </label>

                            <input type="radio" wire:model="create_mssing_picks" class="btn-check ml-4" name="create_mssing_picks" id="create_mssing_picks_no" value="0">
                            <label class="ml-5 btn btn-outline-danger" for="create_mssing_picks_no">
                                <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                            </label>
                        </div>
                </div>

            </div>


        </div>


    </div>
