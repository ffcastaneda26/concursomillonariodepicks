<div class="container">
    <x-jet-validation-errors></x-jet-validation-errors>
    <div class="row align-items-start">
        <div class="col-md-4 flex flex-col">
            <label class="input-group-text mb-2">{{__("Entidad")}}</label>
            <label class="input-group-text mb-2">{{__("Abreviado")}}</label>
            <label class="input-group-text mb-2">{{__("Predeterminado")}}</label>
        </div>

        <div class="col flex flex-col">
            @include('livewire.commons.main_record_input_nombre_field')

            @include('livewire.commons.main_record_input_abreviado_field')

            @include('livewire.commons.input_predeterminado_field')


        </div>
    </div>
</div>
