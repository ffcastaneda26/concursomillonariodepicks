<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                <th>Nombre Website</th>
                <th>Url</th>
                <th>Correo</th>
                <th>¿Pedir Resultados?</th>
                <th>Minutos Pronóstico</th>
                <th>Pronósticos a Seleccionar</th>

                <th>¿Empates?</th>
                <th>¿Crear Pronósticos?</th>
                <th>¿Rol en Registro?</th>
                <th>¿Equipo para desempate?</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $configuration->website_name }}</td>
                    <td>{{ $configuration->website_url }}</td>
                    <td>{{ $configuration->email }}</td>
                    <td align="center">
                        <img src="{{ $configuration->score_picks ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                            alt="{{ $configuration->score_picks ? __('Yes') : 'No' }}"
                            height="24px"
                            width="24px">
                    </td>
                    <td align="center">{{ $configuration->minuts_before_picks }}</td>
                    <td align="center">{{ $configuration->picks_to_select }}</td>


                    <td align="center">
                        <img src="{{ $configuration->allow_tie ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                        alt="{{ $configuration->allow_tie ? __('Yes') : 'No' }}"
                        height="24px"
                        width="24px">
                    </td>



                    <td align="center">
                        <img src="{{ $configuration->create_mssing_picks ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                        alt="{{ $configuration->create_mssing_picks ? __('Yes') : 'No' }}"
                        height="24px"
                        width="24px">
                    </td>


                    <td align="center">
                        <img src="{{ $configuration->assig_role_to_user ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                        alt="{{ $configuration->assig_role_to_user ? __('Yes') : 'No' }}"
                        height="24px"
                        width="24px">
                    </td>


                    <td align="center">
                        <img src="{{ $configuration->use_team_to_tie_breaker ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                        alt="{{ $configuration->use_team_to_tie_breaker ? __('Yes') : 'No' }}"
                        height="24px"
                        width="24px">
                    </td>

                    <td>
                        <button
                            wire:click="edit({{ $configuration->id }})"
                            class="btn btn-success waves-effect waves-light"
                            title="{{__("Edit")}}">
                            <i class="mdi mdi-eye-circle"></i>
                        </button>
                    </td>

                </tr>

        </tbody>
    </table>
</div>
