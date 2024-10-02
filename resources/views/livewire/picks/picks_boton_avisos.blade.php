@if($selected_round >=  $this->current_round)
    <div class="container-fluid mt-2">
        <div class="flex justify-center items-center" >
            <div wire:loading.remove>

                    @if(isset($message) )
                        <div wire:loading.remove >
                            <h1 class=" {{ $error !='success' ? 'text-red-600 text-danger ' : 'text-success bg-green-400' }}text-center text-3xl">
                                {{ $message }}
                            </h1>
                        </div>
                    @endif

                <div class="float-right">
                    <button wire:click="store"
                            class="btn btn-primary float-right">
                            ACTUALIZAR PRONÓSTICOS
                    </button>

                </div>
            </div>

            <div wire:loading>
                <div wire:loading wire:target="store">
                    <p class="bg-white text-black font-bold text-2xl">Procesando...</p>
                </div>
                <div class="flex justify-center items-center" wire:loading wire:target="update_points_last_game">
                    <p class="bg-white text-black font-bold text-2xl">Actualizando Último Partido...</p>
                </div>
            </div>
        </div>
    </div>
@endif
