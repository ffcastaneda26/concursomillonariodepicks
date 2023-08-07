<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                JORNADAS
                            </span>

                             <div class="float-right">
                                <a href="{{ route('rounds.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Fecha Inicio</th>
										<th>Fecha Final</th>
										<th>¿Activa?</th>
										<th>Tipo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>{{ $record->id }}</td>
											<td>{{ $record->start_date }}</td>
											<td>{{ $record->end_date }}</td>
                                            <td class="text-center">
                                                <img src="{{ $record->active ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                                    alt="{{ $record->active ? __('Yes') : 'No' }}"
                                                    height="24px"
                                                    width="24px">
                                            </td>
											<td>{{ $record->type }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $rounds->links() !!} --}}
            </div>
        </div>
    </div>
</div>
