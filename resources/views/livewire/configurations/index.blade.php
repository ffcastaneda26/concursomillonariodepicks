<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="container-fluid mt-2">
                        @include('common.crud_header')

                        @include('common.crud_message')

                        <div class="d-flex flex-row align-items-start col-md-12 gap-2 mb-2">
                            <div class="d-flex flex-row align-items-start col-md-8 gap-2 mb-2">
                                {{--  Boton para crear Registro  --}}
                                @if($allow_create)
                                    @include('common.crud_create_button')
                                @endif
                            </div>
                        </div>
                        @if(!$allow_create)
                            @if(isset($configuration))
                                @include('livewire.configurations.table')
                            @endif
                        @endif

                        {{-- Formulario Crear o Editar --}}
                        @if($isOpen && isset($view_form))
                            @include('common.crud_modal_form')
                        @endif
            </div>
        </div>
    </div>

</div>
