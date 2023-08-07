<td colspan="2" class="px-1 text-center">

    <button
        wire:click="edit({{ $record->id }})"
        class="btn btn-success waves-effect waves-light"
        title="{{__("Edit")}}">
        <i class="mdi mdi-eye-circle"></i>

    </button>

    @if($record->can_be_delete())
        <button  onclick="confirm_modal({{$record->id}})"
            class="btn btn-danger waves-effect waves-light"
            data-bs-toggle="modal"
            data-bs-target="#mySmallModalLabel"
            title="{{__("Delete")}}">
            <i class="mdi mdi-delete"></i>
        </button>
    @else
        <button  type="button"
            class="btn btn-danger waves-effect waves-light"
            data-target="sample-modal"
            disabled
            title="{{__("It ca not delete")}}">
            <i class="mdi mdi-delete"></i>
        </button>
    @endif
</td>
