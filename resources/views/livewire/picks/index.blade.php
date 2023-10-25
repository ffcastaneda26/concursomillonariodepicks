<div class="mt-5">
    @livewire('select-round')
    <div class="container-fluid mt-2">
        <div class="flex justify-center justify-items-centern">
            <div >
               @if(isset($message))
                    <h1 class=" {{ $error !='success' ? 'text-red-600 text-danger ' : 'text-success bg-green-400' }}text-center text-3xl">{{ $message }}</h1>
                @endif
            </div>
            <div class="float-right">
                <button wire:click="store"
                        class="btn btn-primary float-right"
                        wire:loading.remove>
                        ACTUALIZAR PRONÓSTICOS
                </button>
                <div wire:loading wire:target="store">
                    <p class="bg-white text-black font-bold text-2xl">Procesando...</p>
                </div>
            </div>
        </div>


        @if(isset($round_games ))
            <div class="flex justify-center justify-items-center">
                {{-- <div class="col-sm-12"> --}}
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-auto table-striped table-responsive table-hover text-xs">
                                    {{-- Encabezados --}}
                                    <thead class="thead">
                                        <tr class="bg-dark text-white text-center">
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

                                {{-- Avisos de Error + Botón para actualizar pronósticos --}}
                                <div class="flex justify-between">
                                        <div >
                                           @if(isset($message))
                                                <h1 class=" {{ $error !='success' ? 'text-red-600 text-danger ' : 'text-success bg-green-400' }}text-center text-3xl">{{ $message }}</h1>
                                            @endif
                                        </div>
                                        <div class="float-right">
                                            <button wire:click="store"
                                                    class="btn btn-primary float-right"
                                                    wire:loading.remove>
                                                    ACTUALIZAR PRONÓSTICOS
                                            </button>
                                            <div wire:loading wire:target="store">
                                                <p class="bg-white text-black font-bold text-2xl">Procesando...</p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        @endif
    </div>
</div>
