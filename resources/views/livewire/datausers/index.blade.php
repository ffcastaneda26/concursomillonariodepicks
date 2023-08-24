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
                            <select wire:model="entidad_id"
                                    wire:change="lee_entidad"
                                    class="form-select form-select-md  sm:mr-2"
                                    {{ Auth::user()->has_suplementary_data() ? 'disabled' : ''}}>
                                <option value="" selected>Elegir</option>
                                @foreach($entidades as $entidad_select)
                                    <option value="{{ $entidad_select->id }}">{{ $entidad_select->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('entidad_id')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                    {{-- Municipio --}}
                    <div class="col w-40">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><label class="text-center"></label>Municipio</label></span>
                            <select wire:model="municipio_id"
                                    class="form-select form-select-md  sm:mr-2"
                                    {{ Auth::user()->has_suplementary_data() ? 'disabled' : ''}}
                                    {{ !isset($municipios) ? 'disabled' : ''}}>
                                <option value="" selected>Elegir</option>

                                @if(isset($municipios) && $municipios->count())
                                    @foreach($entidad->municipios as $municipio)
                                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                                    @endforeach
                                @endif

                            </select>

                        </div>
                        @error('municipio_id')<div class="badge rounded-pill bg-danger">{{ $message }}</div>@enderror

                    </div>

                    {{-- Código Postal --}}
                    <div class="flex justify-center items-center h-screen">
                        <div class="col w-40">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><label
                                      class="text-center"></label>Código Postal</label></span>
                                <input type="text"
                                        wire:model="codpos"
                                        size="5"
                                        class="{{ $errors->has('codpos') ? 'bg-red-500' : '' }}"
                                        minlength="5"
                                        maxlength="5"
                                        {{Auth::user()->has_suplementary_data() ? 'disabled' : ''}}>
                                @error('codpos')<span class="badge rounded-pill bg-danger">{{ $message }}</span>@enderror
                            </div>

                        </div>
                    </div>



                    {{-- ¿Ya tiene los datos? --}}
                    @if(Auth::user()->has_suplementary_data() )
                        <div class="mt-2 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
                            <div>
                                <h1>CREDENCIAL DEL INE </h1>
                            </div>
                        </div>

                        <div class="flex justify-between items-center h-screen">
                                <div class="card">
                                    <div class="card-heading">Frontal</div>
                                    <div class="card-body">
                                        <img src="{{ Auth::user()->ine_anverso  ? Storage::url(Auth::user()->ine_anverso)
                                                                                : asset('images/negativo.png') }}" alt=""  width="48px">
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading text-center">Reverso</div>
                                    <div class="card-body">
                                        <img src="{{ Auth::user()->ine_reverso  ? Storage::url(Auth::user()->ine_reverso)
                                                                                : asset('images/negativo.png') }}" alt=""  width="48px">
                                    </div>
                                </div>

                        </div>

                        <div class="bg-green-500 mt-5">
                            <h1 style="background-color: rgb(7, 227, 47)">SI DESEA CAMBIAR LOS DATOS COMUNICARSE CON EL ADMINISTRADOR </h1>
                        </div>
                    @endif


                    {{-- Pedir imágenes Credencial del INE --}}
                    @if(!Auth::user()->has_suplementary_data())

                        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
                            <h1 class="text-center">CREDENCIAL DEL INE</h1>
                        </div>

                        {{-- INE Frontal --}}
                        <div class="flex justify-between items-center h-screen mt-2 gap-3">
                            <div class="col-lg-8  col-md-8 mb-4">
                                <label class="fs-5" input-group-prepend>Frontal</label>
                                <input type="file"
                                        wire:model="ine_anverso"
                                        class="form-control {{ $errors->has('ine_anverso') ? 'bg-red-500' : '' }}"
                                        accept="image/png, image/jpeg">
                                @error('ine_anverso')<span class="badge rounded-pill bg-danger">{{ $message }}</span>@enderror

                            </div>

                            <div class="col-lg-8">
                                @if (isset($ine_anverso))
                                    @if(in_array($this->ine_anverso->getClientOriginalExtension(),$extensions_file))
                                      <img src="{{ $ine_anverso->temporaryUrl() }}" class="avatar-md">
                                    @else
                                        <div class="flex items-center">
                                                <label for="" class="underline text-sm text-red-600 dark:text-gray-400 hover:text-red-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800">
                                                    Formato no permitido: Debe ser imagen
                                                </label>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- INE Reverso --}}
                        <div class="flex justify-between items-center h-screen mt-2 gap-3">
                            <div class="col-lg-8  col-md-8 mb-4">
                                <label class="fs-5" input-group-prepend>Reverso</label>
                                <input type="file"
                                        wire:model="ine_reverso"
                                        class="form-control {{ $errors->has('ine_reverso') ? 'bg-red-500' : '' }}">
                                @error('ine_reverso')<span class="badge rounded-pill bg-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="card">
                                <div class="col-lg-8">
                                    @if (isset($ine_reverso))
                                        @if(in_array($this->ine_reverso->getClientOriginalExtension(),$extensions_file))
                                            <img src="{{ $ine_reverso->temporaryUrl() }}" class="avatar-md">
                                        @else
                                            <div class="flex items-center">
                                                    <label for="" class="underline text-sm text-red-600 dark:text-gray-400 hover:text-red-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800">
                                                        Formato no permitido: Debe ser imagen
                                                    </label>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                        {{-- Aceptar que se grabaran --}}
                        <div class="row align-items-start">
                                <div class="mt-4">
                                    <x-label for="confirmar">
                                        <div class="flex items-center">
                                            <x-checkbox wire:model="confirmar" required />
                                            <div class="ml-2">
                                                <label for="" class="underline text-sm text-red-600 dark:text-gray-400 hover:text-red-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800">
                                                    Acepto que al enviar mis datos no podrán ser modificados
                                                </label>
                                            </div>
                                        </div>
                                    </x-label>
                                     @error('confirmar')<span class="badge rounded-pill bg-danger">{{ $message }}</span>@enderror

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
                    @endif
                </form>
            </div>

        </div>


    </div>

</div>
