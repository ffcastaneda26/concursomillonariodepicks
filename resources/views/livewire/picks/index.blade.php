<div class="mt-5">
    @livewire('select-round')
    <div class="container-fluid mt-2">
        <div class="flex justify-between">
            <div >
               @if(isset($message))
                    <h1 class=" {{ $error !='success' ? 'text-red-600 text-danger ' : 'text-success bg-green-400' }}text-center text-3xl">{{ $message }}</h1>
                @endif
            </div>
            <div class="float-right">
                <button wire:click="store" class="btn btn-primary float-right">ACTUALIZAR PRONÓSTICOS</button>
            </div>
        </div>

        @if(isset($round_games ))
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-xs">
                                    <thead class="thead">
                                        <tr class="bg-dark text-white text-center">
                                            {{-- <th>Id</th> --}}
                                            <th>Fecha</th>
                                            <th>Selecciona</th>
                                            <th>Línea</th>
                                            <th colspan="3">Visita</th>
                                            <th colspan="3">Pronóstico  </th>
                                            <th colspan="3">Local</th>
                                            <th>Línea</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($round_games as $game)
                                            <input wire:model='gamesids.{{ $loop->index }}' type="text" class="hidden"/>
                                              @include('livewire.picks.pick_list')
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="flex justify-between">
                                        <div >
                                           @if(isset($message))
                                                <h1 class=" {{ $error !='success' ? 'text-red-600 text-danger ' : 'text-success bg-green-400' }}text-center text-3xl">{{ $message }}</h1>
                                            @endif
                                        </div>
                                        <div class="float-right">
                                            <button wire:click="store" class="btn btn-primary float-right">ACTUALIZAR PRONÓSTICOS</button>

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
