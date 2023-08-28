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

                {{-- Minutos para pronosticar --}}
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Minutos Para Pronosticar</span>
                    <input type="number"
                            wire:model="main_record.minuts_before_picks"
                            required
                            class="mb-2 {{ $errors->has('minuts_before_picks') ? ' is-invalid' : '' }}"
                            size="3"
                            maxlength="4">
                </div>


                <div class="flex flex-row justify-between">
                    {{-- ¿Pedir Resultados? --}}
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

                    {{-- ¿Pemite Empates? --}}
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

                    {{-- ¿Crear pronósticos Faltantes? --}}
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

                <div class="flex flex-col">

                    {{-- ¿Requiere pago para continuar? --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">¿Requiere Pago Para Continuar?</span>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" wire:model="require_payment_to_continue" class="btn-check" name="require_payment_to_continue" id="require_payment_to_continue_yes" value="1">
                                <label class="mr-2 btn btn-outline-success" for="require_payment_to_continue_yes">
                                    <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                                </label>

                                <input type="radio" wire:model="require_payment_to_continue" class="btn-check ml-4" name="require_payment_to_continue" id="require_payment_to_continue_no" value="0">
                                <label class="ml-5 btn btn-outline-danger" for="require_payment_to_continue_no">
                                    <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                                </label>
                            </div>
                    </div>

                    {{-- ¿Requiere datos complementarios para continuar? --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">¿Requiere Datos Complementarios Para Continuar?</span>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" wire:model="require_data_user_to_continue" class="btn-check" name="require_data_user_to_continue" id="require_data_user_to_continue_yes" value="1">
                                <label class="mr-2 btn btn-outline-success" for="require_data_user_to_continue_yes">
                                    <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                                </label>

                                <input type="radio" wire:model="require_data_user_to_continue" class="btn-check ml-4" name="require_data_user_to_continue" id="require_data_user_to_continue_no" value="0">
                                <label class="ml-5 btn btn-outline-danger" for="require_data_user_to_continue_no">
                                    <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                                </label>
                            </div>
                    </div>
                </div>

                {{-- ¿Asignar role al registrarse? --}}
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">¿Asignar Rol Al Registrarse?</span>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" wire:model="assig_role_to_user" class="btn-check" name="assig_role_to_user" id="assig_role_to_user_yes" value="1">
                            <label class="mr-2 btn btn-outline-success" for="assig_role_to_user_yes">
                                <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                            </label>

                            <input type="radio" wire:model="assig_role_to_user" class="btn-check ml-4" name="assig_role_to_user" id="assig_role_to_user_no" value="0">
                            <label class="ml-5 btn btn-outline-danger" for="assig_role_to_user_no">
                                <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                            </label>
                        </div>
                </div>


                {{-- ¿Crear usuario en stripe? --}}
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">¿Crear Usuario en Stripe?</span>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" wire:model="add_user_to_stripe" class="btn-check" name="add_user_to_stripe" id="add_user_to_stripe_yes" value="1">
                            <label class="mr-2 btn btn-outline-success" for="add_user_to_stripe_yes">
                                <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                            </label>

                            <input type="radio" wire:model="add_user_to_stripe" class="btn-check ml-4" name="add_user_to_stripe" id="add_user_to_stripe_no" value="0">
                            <label class="ml-5 btn btn-outline-danger" for="add_user_to_stripe_no">
                                <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                            </label>
                        </div>
                </div>

                {{-- ¿Usar Equipo para partido de desempate? --}}
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">¿Usar Equipo para desempate?</span>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" wire:model="use_team_to_tie_breaker" class="btn-check" name="use_team_to_tie_breaker" id="use_team_to_tie_breaker_yes" value="1">
                            <label class="mr-2 btn btn-outline-success" for="use_team_to_tie_breaker_yes">
                                <img src="{{asset('images/afirmativo.png')}}" alt="SI" width="24px" height="24px">
                            </label>

                            <input type="radio" wire:model="use_team_to_tie_breaker" class="btn-check ml-4" name="use_team_to_tie_breaker" id="use_team_to_tie_breaker_no" value="0">
                            <label class="ml-5 btn btn-outline-danger" for="use_team_to_tie_breaker_no">
                                <img src="{{asset('images/negativo.png')}}" alt="NO" width="24px" height="24px">
                            </label>
                        </div>
                </div>

                {{-- Id del Equipo para el desempate --}}

                @if($use_team_to_tie_breaker)
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Equipo para desempate</span>
                        <select wire:model="team_id">
                            <option value="">Seleccione</option>
                            @foreach ($teams as $team )
                                <option value="{{ $team->id }}"  {{ $team->id == $team_id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                @endif


            </div>


        </div>


    </div>
