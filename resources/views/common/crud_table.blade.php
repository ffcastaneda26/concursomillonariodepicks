@if(isset($records) && $records->count())
    <table class="table table-hover mb-0">
        @if(isset($view_table))
            @include($view_table)
        @endif
        @include('livewire.each_record')
    </table>
    @include('common.crud_pagination')
@else
    @include('common.no_records_found')
@endif
