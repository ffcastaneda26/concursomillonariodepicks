@extends('adminlte::page')

@section('title', 'Administrador')

@section('content')
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
                                    @foreach ($rounds as $round)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $round->start_date }}</td>
											<td>{{ $round->end_date }}</td>
                                            <td class="text-center">
                                                <img src="{{ $round->active ? asset('images/afirmativo.png') : asset('images/negativo.png')}}"
                                                    alt="{{ $round->active ? __('Yes') : 'No' }}"
                                                    height="24px"
                                                    width="24px">
                                            </td>
											<td>{{ $round->type }}</td>

                                            <td>
                                                <form action="{{ route('rounds.destroy',$round->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('rounds.show',$round->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('rounds.edit',$round->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $rounds->links() !!}
            </div>
        </div>
    </div>
@endsection
