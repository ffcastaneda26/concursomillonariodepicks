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
                                                    {{  $my_position_record->position }}
                                                </td>
                                            </tr>
                                            <tr style="background-color:#9BFDC7;">
                                                <td align="center">{{  $my_position_record->position }}</td>
                                                <td align="center">{{ Auth::user()->name }}</td>
                                                <td align="center">{{ $my_position_record->hits }}</td>
                                            </tr>
                                        @endif

                                        @include('livewire.positions.general.header_rounds')
                                        <tbody>
                                            @foreach ($records as $record)
                                                <tr>
                                                    <td align="center">{{ $record->position }}</td>
                                                    <td>{{ $record->name }}</td>
                                                    @php
                                                        $discount = 0;
                                                    @endphp
                                                    @foreach($record->positions_rounds_played($roundsIds)->get() as $position)
                                                        @php
                                                             if ($position->exclude)
                                                                $discount= $discount + $position->hits
                                                        @endphp
                                                        <td align="center" class="{{ $position->exclude  ? 'text-red-500 font-bold' : '' }}">
                                                            {{ $position->hits ? $position->hits : '0' }}
                                                        </td>
                                                    @endforeach
                                                    <td align="center">{{  $record->total + $discount }}</td>
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
