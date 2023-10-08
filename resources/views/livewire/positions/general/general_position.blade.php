<div>

    <div class="container-fluid mt-2">
        @if(isset($records ))
            <div class="mt-3 flex justify-center">
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-lg">
                            @include('livewire.positions.general.header_rounds')
                            {{-- @if(isset($my_position))
                                <tr>
                                    <td colspan="5" class="text-center">SUS DATOS SON: </td>
                                </tr>
                                <tr class="bg-success">
                                    <td align="center">{{ Auth::user()->name }}</td>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach(Auth::user()->positions_rounds_played($roundsIds)->get() as $my_position)
                                        @php
                                            $total = $total + $my_position->hits;
                                        @endphp
                                        <td align="center">
                                            {{ $my_position->hits ? $my_position->hits : '' }}
                                        </td>
                                    @endforeach
                                    <td align="center">{{ $total ? $total : '' }}</td>                                </tr>
                             @endif --}}

                             <tbody>

                                @foreach ($records as $record)
                                    <tr>
                                        <td align="center">{{ $record->position }}</td>
                                        <td>{{ $record->name }}</td>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach($record->positions_rounds_played($roundsIds)->get() as $position)
                                            @php
                                                $total = $total + $position->hits;
                                            @endphp
                                            <td align="center">
                                                {{ $position->hits ? $position->hits : '' }}
                                            </td>
                                        @endforeach
                                        <td align="center">{{ $total ? $total : '' }}</td>
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
        @endif
    </div>
</div>
