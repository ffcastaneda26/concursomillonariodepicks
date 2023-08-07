@if($records && $records->count())
    <div>
        {{ $records->links()}}
    </div>
@endif