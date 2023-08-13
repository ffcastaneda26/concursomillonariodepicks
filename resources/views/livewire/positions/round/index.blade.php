<div>
    @livewire('select-round')
    <div class="container-fluid mt-2">

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-xs">
                                    @include('livewire.positions.round.table')

                                    <tbody>
                                        {{-- @foreach ($round_games as $game)
                                            Datos del participante

                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
