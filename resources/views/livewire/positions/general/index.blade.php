<div>

    <div class="container-fluid mt-2">
        @if(isset($records ))
            <div class="mt-3 flex justify-center">
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-lg">

                            @if(isset($my_position))
                                <tr>
                                    <td colspan="5" class="text-center">USTED OCUPA LA POSICION: {{ $my_position->position }}</td>
                                </tr>
                                <tr class="bg-success">
                                    <td align="center">{{ $my_position->position }}</td>
                                    <td>{{ $my_position->user->name }}</td>
                                    <td align="center">{{ $my_position->hits ?  $my_position->hits : '-'}}</td>
                                    {{-- <td align="center">{{ $my_position->hits_breaker ?  $my_position->hits_breaker : '-'}}</td> --}}
                                    {{-- <td align="center">{{ $my_position->total_error ? $my_position->total_error : '-'}}</td> --}}
                                </tr>
                             @endif

                            @include('livewire.positions.general.table')

                            <tbody>
                                @foreach ($records as $position)
                                    @include('livewire.positions.general.list')
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $records->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
