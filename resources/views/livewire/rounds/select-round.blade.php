<div class="py-2 mt-2">
    <div class="flex  justify-center justify-items-center">
        <div class="card text-center">
            <div class="card-heading"><p class="text-center">JORNADAS</p>
            </div>
                <div class="card-body">
                    @foreach ($rounds as $round)
                        @if($show_all || (!$show_all && $round->id <=  $current_round->id))
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <div class="ml-3">
                                        <button wire:click="select_round({{ $round->id }})"
                                            class="btn  waves-effect waves-light
                                                {{ $current_round->id == $round->id ? 'btn-success'  : '' }}
                                                {{ $selected_round->id == $round->id ? 'btn-warning' : '' }}"
                                        title="{{ $round->id }}">
                                    {{ $round->id }}

                                    </button>
                                    </div>
                                </div>
                        @endif
                    @endforeach
                </div>
       </div>
    </div>

</div>
