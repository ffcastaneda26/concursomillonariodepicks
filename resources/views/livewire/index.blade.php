<div class="container-fluid">
        @if(!$show_back)
            @include('common.crud_header')
        @endif
        @include('common.crud_message')
        {{-- <x-jet-validation-errors></x-jet-validation-errors> --}}
        <div class="d-flex flex-row align-items-start col-md-12 gap-2 mb-2">
            <div class="d-flex flex-row align-items-start col-md-8 gap-2 mb-2">
                {{--  Boton para crear Registro  --}}
                @if($allow_create)
                    @include('common.crud_create_button')
                @endif
                {{--  Vista busquedas de items  --}}

                @if($show_back)
                    <a href="{{ route($back_route)}}">
                        <button type="button"
                                class="btn btn-warning waves-effect"
                                data-target="sample-modal"
                                title="Regresar">
                                Seleccionar Otro
                            <i class="mdi mdi-arrow-left-bold-box"></i>
                        </button>
                    </a>
                @endif

                @if(isset($view_search))
                    @include($view_search)
                @endif
            </div>

            @if($show_back)
            <div class="d-flex flex-row align-items-end  mb-2">
                    <h1>
                        @if(isset($manage_title))
                            {{__($manage_title)}}
                        @endif
                    </h1>
                </div>
            @endif
        </div>

        {{--  Modal para confirmar elemento --}}
        @if($confirm_delete)
            @include('common.confirm_delete')
        @endif

        {{-- Detalle de registros --}}
        @if($view_table)
            <div class="table-responsive bg-white">
                @include('common.crud_table')
            </div>
        @endif

        {{-- Formulario Crear o Editar --}}
        @if($isOpen && isset($view_form))
            @include('common.crud_modal_form')
        @endif
</div>
