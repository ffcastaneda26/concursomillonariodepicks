<x-app-layout>
    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('concurso_dashboard_main_menu')

                {{-- ¿Que es el concurso? --}}
                @include(' concurso_que_es')
                {{-- ¿Bases concurso? --}}

                @include('concurso_bases')

                    {{-- Semanas de Descanso --}}
                    @include('concurso_semanas_descanso')
            </div>
        <a href="#" class="fixed bottom-5 right-10 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Arriba</a>


    </div>
</x-app-layout>
