<div>

    <div class="container-fluid mt-2">
        @if(isset($records ))
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-xs">
                                    @include('livewire.positions.general.table')
                                    <tbody>
                                        @foreach ($records as $position)
                                            @include('livewire.positions.general.list')
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $records->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
