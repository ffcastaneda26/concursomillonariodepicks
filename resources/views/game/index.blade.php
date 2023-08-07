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
                                {{ __('Game') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('games.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
									    <th>Jornada</th>
                                        <th>Fecha</th>
										<th>Local</th>
										<th>Puntos</th>
										<th>Visita</th>
										<th>Puntos</th>
										<th>Ganador</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($games as $game)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $game->round_id }}</td>
                                            <td>{{$game->game_day->format('j-F-Y')}} {{$game->game_time->format('h:i A') }}</td>
											<td>{{ $game->local_team->name }}</td>
											<td>{{ $game->local_points }}</td>
											<td>{{ $game->visit_team->name }}</td>
											<td>{{ $game->visit_points }}</td>
											<td>
                                                @switch($game->winner)
                                                    @case(0)
                                                        Empate
                                                        @break
                                                    @case(1)
                                                       Local
                                                        @break
                                                    @case(2)
                                                        Visita
                                                        @break
                                                    @default
                                                       Pendiente
                                                @endswitch
                                            </td>

                                            <td>
                                                <form action="{{ route('games.destroy',$game->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('games.show',$game->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('games.edit',$game->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $games->links() !!}
            </div>
        </div>
    </div>
@endsection
