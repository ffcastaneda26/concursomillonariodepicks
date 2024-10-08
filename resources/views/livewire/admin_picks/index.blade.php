<div class="mt-5">
    @livewire('select-round')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="flex justify-center justify-items-center">
                <div class="card">
                    <div class="card-body">
                        @role('Admin')
                            <div class="search-bar ml-5 mb-2">
                                <select wire:model="user_id"
                                        wire:change="read_user"
                                        class="form-select search-input">
                                        <option value="">Usuario</option>
                                        @foreach($users as $pick_user)
                                                <option value="{{ $pick_user->id }}">
                                                    {{ $pick_user->name }}
                                                </option>
                                        @endforeach
                                </select>
                            </div>
                        @endrole
                        <div >
                            @if(isset($message))
                                <h1 class=" {{ $error !='success' ? 'text-red-600 text-danger ' : 'text-success bg-green-400' }}text-center text-3xl">{{ $message }}</h1>
                            @endif
                        </div>
                        <div class="float-right {{ $user_id ? '' : 'invisible'}}">
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
        </div>

        @if(isset($round_games ) && $user_id)
            <div class="row">
                <div class="flex justify-center justify-items-center">
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
                                            <th class="{{ $user->require_bet ? 'block' : 'hidden' }}">
                                                Apuesta
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($round_games as $game)
                                            <input wire:model='gamesids.{{ $loop->index }}' type="text" class="hidden"/>
                                             @include('livewire.admin_picks.pick_list')
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="flex justify-between">
                                        <div >
                                           @if(isset($message))
                                                <h1 class=" {{ $error !='success' ? 'text-red-600 text-danger ' : 'text-success bg-green-400' }}text-center text-3xl">{{ $message }}</h1>
                                            @endif
                                        </div>
                                        <div class="float-right {{ $user_id ? '' : 'invisible'}}">
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
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
