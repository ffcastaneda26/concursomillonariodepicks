@livewire('select-round')
<thead>
    <tr class="bg-dark text-white text-center">
        <th class="px-4 py-2"
            wire:click="order('name')">
            @if($sort == 'name')
                @if($direction == 'asc')
                    <span class="float-right"><i class="mdi mdi-arrow-up "></i></span>
                @else
                    <span class="float-right"><i class="mdi mdi-arrow-down"></i></span>
                @endif
            @else
                <span class="float-right"><i class="mdi mdi-sort"></i></span>

            @endif
            Equipo
        </th>
        <th>Alias</th>
        <th>Corto</th>
        <th>Logo</th>
        <th colspan="2" class="px-4 py-2">Acciones</th>
    </tr>
</thead>

