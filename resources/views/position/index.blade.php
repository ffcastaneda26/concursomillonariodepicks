@extends('layouts.app')

@section('template_title')
    Position
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Position') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('positions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>
                                        
										<th>Round Id</th>
										<th>User Id</th>
										<th>Hits</th>
										<th>Extra Points</th>
										<th>Dif Winner Points</th>
										<th>Dif Total Points</th>
										<th>Dif Local Points</th>
										<th>Dif Visit Points</th>
										<th>Dif Victory</th>
										<th>Hit Last Game</th>
										<th>Hit Visit</th>
										<th>Hit Local</th>
										<th>Position</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($positions as $position)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $position->round_id }}</td>
											<td>{{ $position->user_id }}</td>
											<td>{{ $position->hits }}</td>
											<td>{{ $position->extra_points }}</td>
											<td>{{ $position->dif_winner_points }}</td>
											<td>{{ $position->dif_total_points }}</td>
											<td>{{ $position->dif_local_points }}</td>
											<td>{{ $position->dif_visit_points }}</td>
											<td>{{ $position->dif_victory }}</td>
											<td>{{ $position->hit_last_game }}</td>
											<td>{{ $position->hit_visit }}</td>
											<td>{{ $position->hit_local }}</td>
											<td>{{ $position->position }}</td>

                                            <td>
                                                <form action="{{ route('positions.destroy',$position->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('positions.show',$position->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('positions.edit',$position->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $positions->links() !!}
            </div>
        </div>
    </div>
@endsection
