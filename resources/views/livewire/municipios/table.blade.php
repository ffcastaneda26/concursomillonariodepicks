<thead>
    <tr class="bg-dark text-white text-center">
        <th wire:click="order('entidad_id')">
            @if($sort == 'entidad_id')
                @if($direction == 'asc')
                    <span class="float-right"><i class="mdi mdi-arrow-up "></i></span>
                @else
                    <span class="float-right"><i class="mdi mdi-arrow-down"></i></span>
                @endif
            @else
                <span class="float-right"><i class="mdi mdi-sort"></i></span>

            @endif
            Entidad
        </th>
        <th wire:click="order('municipio')">
                @if($sort == 'municipio')
                    @if($direction == 'asc')
                        <span class="float-right"><i class="mdi mdi-arrow-up "></i></span>
                    @else
                        <span class="float-right"><i class="mdi mdi-arrow-down"></i></span>
                    @endif
                @else
                    <span class="float-right"><i class="mdi mdi-sort"></i></span>

                @endif
                Municipio
        </th>
        <th>Predeterminado</th>
        <th colspan="2" class="text-center">{{__("Actions")}}</th>
    </tr>
</thead>




