<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Configuration') }}
                        </span>

                         <div class="float-right">
                            <a href="{{ route('configurations.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                              {{ __('Create New') }}
                            </a>
                          </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre Website</th>
                                    <th>Url</th>
                                    <th>Correo</th>
                                    <th>¿Pedir Resultados?</th>
                                    <th>MinutosPronóstico</th>
                                    <th>¿Empates?</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $configuration->website_name }}</td>
                                        <td>{{ $configuration->website_url }}</td>
                                        <td>{{ $configuration->email }}</td>
                                        <td class="text-center">
                                            <img src="{{ $configuration->score_picks ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                                alt="{{ $configuration->score_picks ? __('Yes') : 'No' }}"
                                                height="24px"
                                                width="24px">
                                        </td>
                                        <td>{{ $configuration->minuts_before_picks }}</td>

                                        <td>
                                            <img src="{{ $configuration->allow_tie ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                            alt="{{ $configuration->allow_tie ? __('Yes') : 'No' }}"
                                            height="24px"
                                            width="24px">
                                        </td>

                                        <td>
                                            <img src="{{ $configuration->create_mssing_picks ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                            alt="{{ $configuration->create_mssing_picks ? __('Yes') : 'No' }}"
                                            height="24px"
                                            width="24px">
                                        </td>

                                        <td>
                                            <form action="{{ route('configurations.destroy',$configuration->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('configurations.show',$configuration->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('configurations.edit',$configuration->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
