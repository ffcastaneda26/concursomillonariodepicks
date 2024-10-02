<div class="mt-5">
    @livewire('select-round')

    @if(isset($round_games ))


        @include('livewire.picks.picks_boton_avisos')

        <div class="flex justify-center justify-items-center">

            <div class="card text-center">
                <div class="flex flex-col items-center" width="300px" height="250px" wire:loading>
                    <div class="spinner"></div>
                </div>
                <div class="card-body" wire:loading.class="opacity-50">

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

                            <!-- Detalle de juegos -->
                            <tbody>
                                @foreach ($round_games as $game)
                                    <input wire:model='gamesids.{{ $loop->index }}' type="text" class="hidden"/>
                                    @include('livewire.picks.pick_list')
                                @endforeach
                            </tbody>
                        </table>
                        @if($selected_round >=  $this->current_round)
                            <div class="flex text-center justify-center font-bold text-lg">
                                No olvide actualizar pronósticos haciendo clic en el botón
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        @include('livewire.picks.picks_boton_avisos')
    @endif

</div>
