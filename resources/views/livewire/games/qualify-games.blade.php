<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="container-fluid mt-2">
                        @include('common.crud_header')

                        <div class="d-flex flex-row align-items-start col-md-12 gap-2 mb-2">
                            <div class="card" style="width: 18rem;">
                                <div class="card-header">
                                    CALIFICACION DE PRONOSTICOS
                                    <div class="flex justify-center items-center">
                                        @if(isset($games) && $games->count())
                                            <h5 class="card-title">Juegos con Resultado: {{ $games->count() }}</h5>
                                        @else
                                            <h5 class="card-title text-center">NO HAY JUEGOS CON RESULTADOS PARA CALIFICAR</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>

</div>
