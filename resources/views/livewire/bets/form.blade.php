    <div class="container">

        <x-validation-errors></x-validation-errors>


        <div class="row align-items-start">
            <div class="col-md-4 flex flex-col mt-2">
                <label class="input-group-text mb-2">Nombre</label>
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
                            maxlength="30">
                </div>
            </div>
        </div>
    </div>
