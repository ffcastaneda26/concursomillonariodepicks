<div class="container-fluid">
    <div class="row">
        <div class="mt-5 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <h1>DATOS COMPLEMENTARIOS </h1>
            </div>

            <div class="flex justify-center items-center h-screen mt-2">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    {{-- Entidad Federativa --}}
                    <div class="col w-40">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><label class="text-center"></label>Entidad</label></span>
                            <select wire:model.defer="main_record.entidad_id"
                                    wire:change="lee_entidad"
                                    class="form-select form-select-md  sm:mr-2">
                                <option value="" selected>Elegir</option>
                                @foreach($entidades as $entidad_select)
                                    <option value="{{ $entidad_select->id }}">{{ $entidad_select->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('main_record.entidad_id')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror


                    <div class="col w-40">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><label class="text-center"></label>Municipio</label></span>
                            <select wire:model.defer="main_record.municipio_id"
                                    class="form-select form-select-md  sm:mr-2">
                                <option value="" selected>Elegir</option>
                                @foreach($entidad->municipios as $municipio)
                                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('main_record.municipio_id')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                    </div>


                    <div class="flex justify-center items-center h-screen">
                        <div class="col w-40">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><label
                                      class="text-center"></label>Código Postal</label></span>
                                <input type="text"
                                        wire:model="main_record.codpos"
                                        size="5"
                                        class="{{ $errors->has('codpos') ? 'bg-red-500' : '' }}"
                                        minlength="5"
                                        maxlength="5">
                                @error('main_record.codpos')<span class="badge rounded-pill bg-danger">{{ $message }}</span>@enderror
                            </div>

                        </div>
                    </div>

                    @if($main_record->ine_anverso || $main_record->ine_reverso )

                        <div class="flex justify-between items-center h-screen text-center">
                            <h1>CREDENCIAL DEL INE</h1>
                        </div>


                        <div class="flex justify-between items-center h-screen">
                                <div class="card">
                                    <div class="card-heading">ANVERSO</div>
                                    <div class="card-body">
                                        <img src="{{ $main_record->ine_anverso  ? Storage::url($main_record->ine_anverso)
                                                                                : asset('images/negativo.png') }}" alt=""  width="48px">
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading text-center">REVERSO</div>
                                    <div class="card-body">
                                        <img src="{{ $main_record->ine_reverso  ? Storage::url($main_record->ine_reverso)
                                                                                : asset('images/negativo.png') }}" alt=""  width="48px">
                                    </div>
                                </div>

                        </div>

                    @endif
                    {{-- @if($main_record->ine_anverso || $main_record->ine_reverso ) --}}
                        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
                            <h1 class="text-center">SI DESEA CAMBIAR LA IDENTIFICACION</h1>
                        </div>
                    {{-- @endif --}}
                    {{-- INE Reverso --}}
                    <div class="flex justify-between items-center h-screen mt-2 gap-3">
                        <div class="col-lg-8  col-md-8 mb-4">
                            <label class="fs-5" input-group-prepend>INE Anverso</label>
                            <input type="file"
                                    wire:model="ine_anverso"
                                    class="form-control {{ $errors->has('ine_anverso') ? 'bg-red-500' : '' }}">
                            @error('ine_anverso')<span class="badge rounded-pill bg-danger">{{ $message }}</span>@enderror

                        </div>

                        <div class="col-lg-8">
                            @if (isset($ine_anverso))
                                <img src="{{ $ine_anverso->temporaryUrl() }}" class="avatar-md">
                            @endif
                        </div>
                    </div>

                    {{-- INE Anverso --}}
                    <div class="flex justify-between items-center h-screen mt-2 gap-3">
                        <div class="col-lg-8  col-md-8 mb-4">
                            <label class="fs-5" input-group-prepend>INE Reverso</label>
                            <input type="file"
                                    wire:model="ine_reverso"
                                    class="form-control {{ $errors->has('ine_reverso') ? 'bg-red-500' : '' }}">
                            @error('ine_reverso')<span class="badge rounded-pill bg-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="card">
                            <div class="col-lg-8">
                                @if (isset($ine_reverso))
                                    <img src="{{ $ine_reverso->temporaryUrl() }}" class="avatar-md">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <span class="mx-2">
                            <button wire:click.prevent="store()"
                                class="btn btn-success">
                                {{__("Save")}}
                            </button>
                        </span>
                    </div>
                </form>
            </div>

        </div>


    </div>

</div>
