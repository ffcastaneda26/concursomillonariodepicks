<div>
    <div class="container-fluid mt-2">
        @if(isset($records ))
            <div class="flex  justify-center justify-items-center">
                    <div class="card">
                        <div class="card-body ">
                            <div class="col-sm-12">
                                    <table class="table table-striped table-responsive table-hover text-xs">
                                        @if(isset($my_position))
                                            @php
                                                $my_position_record= Auth::user()->general_position()->first();
                                            @endphp
                                            <tr>
                                                <td colspan="20" class="text-center">USTED OCUPA LA POSICION:
                                                    {{  $my_position_record->position_extra_contest }}
                                                </td>
                                            </tr>
                                            <tr style="background-color:#9BFDC7;">
                                                <td align="center">{{  $my_position_record->position_extra_contest }}</td>
                                                <td align="center">{{ Auth::user()->name }}</td>
                                                <td align="center">{{ $my_position_record->hits_extra_contest }}</td>
                                            </tr>
                                        @endif

                                        @include('livewire.positions.general.header_rounds_extra')
                                        <tbody>
                                            @foreach ($records as $record)

                                                <tr>
                                                    <td align="center">{{ $record->position_extra_contest }}</td>
                                                    <td>{{ $record->name }}</td>
                                                    @foreach($record->positions_rounds_played($roundsIds)->get() as $position)
                                                        <td align="center">
                                                            {{ $position->hits ? $position->hits : '0' }}
                                                        </td>
                                                    @endforeach
                                                    <td align="center">{{  $record->total ? $record->total : '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $records->links()}}
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
        @endif
    </div>
</div>

