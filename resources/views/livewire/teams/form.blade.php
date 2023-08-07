    <div class="container">
        {{-- <x-jet-validation-errors></x-jet-validation-errors> --}}
        <x-validation-errors></x-validation-errors>
        <div class="row align-items-start">
            <div class="col-md-4 flex flex-col mt-2">
                <label class="input-group-text mb-2">Nombre</label>
                <label class="input-group-text mb-2">Alias</label>
                <label class="input-group-text mb-2">Corto</label>
            </div>

            <div class="col flex flex-col mt-2">
                {{-- Nombre --}}
                <div class="flex-flex-column">
                    <input type="text"
                            wire:model="main_record.name"
                            required
                            placeholder="Nombre"
                            class="form-control mb-2"
                            size="30"
                            maxlength="50">
                </div>

                {{-- Alias --}}
                <div class="flex-flex-column">
                    <input type="text"
                            wire:model="main_record.alias"
                            required
                            placeholder="Alias"
                            class="form-control mb-2"
                            size="30"
                            maxlength="30">
                </div>

                {{-- Corto --}}
                <div class="flex-flex-column">
                    <input type="text"
                            wire:model="main_record.short"
                            required
                            class="form-control-sm mb-2"
                            size="4"
                            maxlength="3">
                </div>
            </div>

            {{-- Logotipo --}}
            <div class="row mt-2">
                <div class="row align-items-start">

                    <div class="col-lg-10  col-md-8 mb-4">
                        <label class="fs-5" input-group-prepend>Logotipo</label>
                        <input type="file"
                                wire:model="logotipo"
                                {{$allow_edit ? '' : 'disabled' }}
                                class="form-control">
                    </div>

                    <div class="col-lg-8">
                        @if (isset($logotipo))
                            <img src="{{ $logotipo->temporaryUrl() }}" class="avatar-md">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
